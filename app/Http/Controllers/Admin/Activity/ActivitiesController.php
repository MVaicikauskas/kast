<?php

namespace app\Http\Controllers\Admin\Activity;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Activity\Activity;
use app\Models\Activity\ActivityCategory;
use app\Models\Activity\ActivitySubCategory;
use app\Models\Activity\ActivityRegion;
use app\Models\Events\Event;
use app\Models\Events\EventCategory;
use app\Models\Events\EventRegion;
use app\Models\Media\Media;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;
use Image;

class ActivitiesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::with(['category','subcategory','region'])->latest()->paginate(25);

        return view('admin.activities.list', [
            'activities' => $activities,
            'data' => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activities.create')->with([
            'data' => $this->getUnconfirmedEvents(),
            'categories' => ActivityCategory::all(),
            'subcategories' => ActivitySubCategory::all(),
            'regions' => ActivityRegion::all()
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
          'name' => 'required|min:3',
          'category_id' => 'required',
          'subcategory_id' => 'required',
          'region_id' => 'required',
          'email' => 'required|email',
          'phone' => 'required',
          'excerpt' => 'required',
          'description' => 'required',
          'address' => 'required',
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $activity = new Activity;

        $activity->name = $request->name;
        $activity->slug = Str::slug($request->name);
        $activity->category_id = $request->category_id;
        $activity->subcategory_id = $request->subcategory_id;
        $activity->region_id = $request->region_id;

        $activity->excerpt = $request->excerpt;
        $activity->description = $request->description;

        $activity->email = $request->email;
        $activity->phone = $request->phone;
        $activity->address = $request->address;
        $activity->facebook_link = $request->facebook_link;
        $activity->website = $request->website;

			
		//dd(time());	
			
        if(($request->hasFile('image'))) {
          $name = md5(round(microtime(true) * 1000)) . '.' . $request->image->getClientOriginalExtension();

          $savePath = 'storage_old/activities/';

          if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
          }

          Image::make($request->image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

          $activity->image = $name;
        }

        $activity->recommended = false;
        $activity->save();

        if ($request->hasFile('media')) {
          foreach ($request->file('media') as $file) {
            $extension = $file->getClientOriginalExtension();
            $filesize = $file->getSize();
  
            $name = md5(round(microtime(true) * 1000)) . '.' . $extension;
  
            $imageExtensions = 'jpeg,png,jpg,gif,svg';
            $videoExtensions = 'mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts';
            
            $path = '';
            $savePath = 'storage_old/activities/';
  
            if (strpos($imageExtensions, strtolower($extension))) {
              $path = public_path($savePath) . $name;
  
              Image::make($file->getRealPath())
                  ->resize(1200, null, function ($constraint) {
                      $constraint->aspectRatio();
                  })
                  ->save($path);
            } else if (strpos($videoExtensions, $extension)) {
              $path = $file->storeAs(
                $savePath, $name, 'public'
              );
            }

            $activity->media()->create([
              'name' => $name,
              'path' => $path,
              'extension' => $extension,
              'filesize' => $filesize,
            ]);
          }
        }

        $request->session()->flash('alert-success', 'New activity added');
        return redirect()->route('activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('admin.activities.delete')->with([
        'activity' => Activity::findOrFail($id),
        'data' => $this->getUnconfirmedEvents()
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
      return view('admin.activities.edit')->with([
        'activity' => Activity::findOrFail($id),
        'categories' => ActivityCategory::all(),
        'subcategories' => ActivitySubCategory::all(),
        'regions' => ActivityRegion::all(),
        'data'  => $this->getUnconfirmedEvents()
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
        'name' => 'required|min:3',
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'region_id' => 'required',
        'excerpt' => 'required',
        'description' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      $activity = Activity::findOrFail($id);

      $activity->name = $request->name;
      $activity->slug = Str::slug($request->name);
      $activity->category_id = $request->category_id;
      $activity->subcategory_id = $request->subcategory_id;
      $activity->region_id = $request->region_id;

      $activity->excerpt = $request->excerpt;
      $activity->description = $request->description;

      $activity->email = $request->email;
      $activity->phone = $request->phone;
      $activity->address = $request->address;
      $activity->facebook_link = $request->facebook_link;
      $activity->website = $request->website;
      
      if(($request->hasFile('image'))) {
        $name = md5(round(microtime(true) * 1000)) . '.' . $request->image->getClientOriginalExtension();
		//dump($extension);	

        $path = '';
        $savePath = 'storage_old/activities/';

        if (!File::exists($savePath)) {
          File::makeDirectory($savePath, 0777, true, true);
        }

        Image::make($request->image->getRealPath())
              ->resize(1200, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path($savePath) . $name);

        $activity->image = $name;
      }
      $activity->recommended = false;
      $activity->save();

      if ($request->hasFile('media')) {
        foreach ($request->file('media') as $file) {
          $extension = $file->getClientOriginalExtension();
          $filesize = $file->getSize();

          $name = md5(round(microtime(true) * 1000)) . '.' . $extension;
		  

          $imageExtensions = 'jpeg,png,jpg,gif,svg';
          $videoExtensions = 'mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts';

          $savePath = 'storage_old/activities/';

          if (strpos($imageExtensions, strtolower($extension))) {
            $path = public_path($savePath) . $name;
			//dump($extension);	
            Image::make($file->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path);

            
          } else if (strpos($videoExtensions, $extension)) {
            $path = $file->storeAs(
              'activities', $name
            );
          }

          $activity->media()->create([
            'name' => $name,
            'path' => $path,
            'extension' => $extension,
            'filesize' => $filesize,
          ]);
        }
      }
		//dd();
      $request->session()
        ->flash('alert-warning', $activity->name . ' updated successfully');

      return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);

        $imagePath = public_path('storage_old/activities/') . $activity->image;
        if (File::exists($imagePath)) {
          File::delete($imagePath);
        }

        // DELETE ALL MEDIA

        $activity->delete();

        return redirect()->route('activities.index')
          ->with('alert-danger', $activity->name . ' was deleted');
    }

    public function deleteFile($id)
    {
      $file = Media::find($id);
      $path = 'storage_old/activities/';

      if (File::exists(public_path($path) . $file->name)) {
        File::delete(public_path($path) . $file->name);
      }

      $file->delete();
    }
}
