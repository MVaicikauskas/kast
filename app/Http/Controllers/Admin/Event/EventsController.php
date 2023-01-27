<?php

namespace app\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Events\Event;
use app\Models\Events\EventCategory;
use app\Models\Events\EventRegion;

use app\Models\Media\Media;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class EventsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.list')->with([
            'events'    => Event::where('confirmed', 1)->latest()->orderByDate()->get(),
            'data'      => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Event::find(1)->categories()->orderBy('name')->get());
        return view('admin.events.create')->with([
            'categories'    => EventCategory::all(),
            'additional_categories' => EventCategory::all(),
            'regions'       => EventRegion::all(),
            'data'          => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:3',
            'category_id' => 'required',
            'region_id' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        'date' => 'required|date',
	        'start_time' => 'required'
        ]);

        $event = new Event;

        $event->title = $request->title;
        $event->slug = Str::slug($request->title) . "-" . Str::slug($request->date);
        $event->category_id = $request->category_id;
        $event->region_id = $request->region_id;
        $event->excerpt = $request->excerpt;
        $event->description = $request->description;

        $event->is_free = $request->is_free === 'yes' ? true : false;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->website = $request->website;
        $event->ticket_link = $request->ticket_link;
        $event->facebook_link = $request->facebook_link;
        $event->confirmed = 1;
        
        if(($request->hasFile('image'))) {
          $name = md5(time()) . '.' . $request->image->getClientOriginalExtension();

          $savePath = 'storage_old/events/';

          if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
          }

          Image::make($request->image->getRealPath())
              ->resize(1200, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path($savePath) . $name);

          $event->image = $name;
        }

        if ($request->hasFile('media')) {
    
            foreach ($request->file('media') as $file) {
          
              $extension = $file->getClientOriginalExtension();
              $filesize = $file->getSize();

              $name = md5(time()) . '.' . $extension;

              $imageExtensions = 'jpeg,png,jpg,gif,svg';
              
              $path = '';
              $savePath = 'storage_old/events/';

              if (strpos(strtolower($imageExtensions), strtolower($extension))) {
          
                $path = public_path($savePath) . $name;

                Image::make($file->getRealPath())
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($path);
              }

              $event->media()->create([
                'name' => $name,
                'path' => $path,
                'extension' => $extension,
                'filesize' => $filesize,
              ]);
            }
    
        }

        $event->save();

        if ($request->has_alternative_dates === 'yes') {
          foreach ($event->alternativeDate as $altDate) {
            $altDate->delete();
          }

          if (!empty($request->alt_date_1) && !empty($request->alt_start_time_1)) {
            $event->alternativeDate()->create([
              'date' => $request->alt_date_1,
              'start_time' => $request->alt_start_time_1,
              'end_time' => $request->alt_end_time_1
            ]);
          }

          if (!empty($request->alt_date_2) && !empty($request->alt_start_time_2)) {
            $event->alternativeDate()->create([
              'date' => $request->alt_date_2,
              'start_time' => $request->alt_start_time_2,
              'end_time' => $request->alt_end_time_2
            ]);
          }

          if (!empty($request->alt_date_3) && !empty($request->alt_start_time_3)) {
            $event->alternativeDate()->create([
              'date' => $request->alt_date_3,
              'start_time' => $request->alt_start_time_3,
              'end_time' => $request->alt_end_time_3
            ]);
          }
        }

        $request->session()->flash('alert-success', 'New event added');
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.events.delete')->with([
            'event'     => Event::findOrFail($id),
            'data'      => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.events.edit')->with([
            'event'         => Event::findOrFail($id),
            'categories'    => EventCategory::all(),
            'regions'     => EventRegion::all(),
            'data'          => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3',
            'category_id' => 'required',
            'region_id' => 'required',
            'location' => 'required',
	        'date' => 'required|date',
	        'start_time' => 'required'
        ]);

        $event = Event::findOrFail($id);

        $event->title = $request->title;
		$event_old_slug = $event->slug;
		if( $event->created_at > '2022-02-15 00:00:00' ) { //for new events
			$event->slug = Str::slug($request->title) . "-" . Str::slug($request->date);
		}else {//for old events
			$event->slug = Str::slug($request->title);
		}
        $event->category_id = $request->category_id;
        $event->region_id = $request->region_id;
        $event->excerpt = $request->excerpt;
        $event->description = $request->description;
        
        // Check if user attached file
        // Create a random name for image
        // Use Image Intervention to make file,
        // resize it to 1200 width and maintain aspect ratio (auto height)
        // save it to storage/events/fileName.fileExtension
        if(($request->hasFile('image'))) {
            
            $name = md5(round(microtime(true) * 1000)) . '.' . $request->image->getClientOriginalExtension();

            $savePath = 'storage_old/events/';

            if (!File::exists($savePath)) {
              File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

            $event->image = $name;
        }

        $event->is_free = $request->is_free === 'yes' ? true : false;
        $event->date = $request->date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->website = $request->website;
        $event->ticket_link = $request->ticket_link;
        $event->facebook_link = $request->facebook_link;
        $event->confirmed = 1;

        $event->save();

        if ($request->has_alternative_dates === 'yes') {
          foreach ($event->alternativeDate as $altDate) {
            $altDate->delete();
          }

          if (!empty($request->alt_date_1) && !empty($request->alt_start_time_1)) {
            $event->alternativeDate()->create([
              'date' => $request->alt_date_1,
              'start_time' => $request->alt_start_time_1,
              'end_time' => $request->alt_end_time_1
            ]);
          }

          if (!empty($request->alt_date_2) && !empty($request->alt_start_time_2)) {
            $event->alternativeDate()->create([
              'date' => $request->alt_date_2,
              'start_time' => $request->alt_start_time_2,
              'end_time' => $request->alt_end_time_2
            ]);
          }

          if (!empty($request->alt_date_3) && !empty($request->alt_start_time_3)) {
            $event->alternativeDate()->create([
              'date' => $request->alt_date_3,
              'start_time' => $request->alt_start_time_3,
              'end_time' => $request->alt_end_time_3
            ]);
          }
        }

        if ($request->hasFile('media')) {
          foreach ($request->file('media') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filesize = $file->getSize();
  
            $name = md5(time()) . '.' . $extension;
  
            $imageExtensions = 'jpeg,png,jpg,gif,svg';
            
            $path = '';
            $savePath = 'storage_old/events/';
  
            if (strpos($imageExtensions, $extension)) {
              $path = public_path($savePath) . $name;
  
              Image::make($file->getRealPath())
                  ->resize(1200, null, function ($constraint) {
                      $constraint->aspectRatio();
                  })
                  ->save($path);
            }

            $event->media()->create([
              'name' => $name,
              'path' => $path,
              'extension' => $extension,
              'filesize' => $filesize,
            ]);
          }
        }

        $request->session()->flash("alert-warning", "'{$request->title}' updated successfully");
	    if( $event->wasChanged('title') ) {
		    $request->session()->flash( "alert-danger", "Event title changed, URL also! Set 301 redirect from [..{$event_old_slug}] to new URL [...{$event->slug}], for SEO purposes. Applicable for indexed URL only" );
	    }
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $imagePath = public_path('storage_old/events/') . $event->image;
        if (File::exists($imagePath)) {
          File::delete($imagePath);
        }

        $event->delete();
        
        return redirect()->route('events.index')->with('alert-danger', $event->title . ' was deleted');
    }


    /*
        Unapproved events
     */
    public function unapprovedEvents()
    {
        return view('admin.events.unapproved')->with([
            'events'    => Event::all()->where('confirmed', 0),
            'data'      => $this->getUnconfirmedEvents()
        ]);
    }

    public function unapprove($id) {
        $event = Event::findOrFail($id);
        $event->confirmed = 0;
        $event->save();

        return redirect()->back()->with('alert-danger', $event->title . ' event was unapproved');
    }

    public function approve($id) {
        $event = Event::findOrFail($id);
        $event->confirmed = 1;
        $event->save();

        return redirect()->back()->with('alert-success', $event->title . ' event was approved');
    }

    public function recommend($id) {
        Event::findOrFail($id)->update([
            'recommended' => true
        ]);

        return redirect()->back()->with('alert-success', 'Event was added to recommended list');
    }

    public function unrecommend($id) {
        Event::findOrFail($id)->update([
            'recommended' => false
        ]);

        return redirect()->back()->with('alert-danger', 'Event was removed from recommended list');
    }

    public function deleteFile($id)
    {
      $file = Media::find($id);
      $path = 'storage_old/events/';

      if (File::exists(public_path($path) . $file->name)) {
        File::delete(public_path($path) . $file->name);
      }

      $file->delete();
    }
}
