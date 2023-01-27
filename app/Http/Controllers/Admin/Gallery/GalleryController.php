<?php

namespace app\Http\Controllers\Admin\Gallery;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;
use app\Models\Gallery\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class GalleryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $gallery = Gallery::all();

      return view('admin.gallery.list', [
        'images' => $gallery,
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
      return view('admin.gallery.create', [
        'data' => $this->getUnconfirmedEvents()
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
        'author' => 'required|min:3'
      ]);

      $gallery = new Gallery;

      $gallery->author = $request->author;
      

      if (!empty($request['image'])) {
            if(($request->hasFile('image'))) {
        
              $name = md5(time()) . '.' . $request->image->getClientOriginalExtension();

              $savePath = 'storage_old/gallery/';

              if (!File::exists($savePath)) {
                File::makeDirectory($savePath, 0777, true, true);
              }
              
              Image::make($request->image->getRealPath())
                    ->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save(public_path($savePath) . $name);

              $gallery->image = $name;
            }
      }else{$gallery->image = null;}

      //  Video
      if (!empty($request['video'])) {
              if(!empty($request->file('video'))) {
                    $name = md5(time()) . '.' . $request->video->getClientOriginalExtension();
            
                    $VideoSavePath = 'storage_old/gallery/';
            
                    $request->file('video')->storeAs('gallery', $name, 'public');

                    if (File::exists(public_path($VideoSavePath) . $gallery->video)) {
                      File::delete(public_path($VideoSavePath) . $gallery->video);
                    }

                    $gallery->video = $name;
              }
      }else{$gallery->video = null;}

      $gallery->save();

      $request->session()->flash('alert-success', 'New image added');
      return redirect()->route('gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('admin.gallery.delete')->with([
        'image' => Gallery::findOrFail($id),
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
      return view('admin.gallery.edit')->with([
        'image' => Gallery::findOrFail($id),
        'data' => $this->getUnconfirmedEvents()
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
        'author' => 'required|min:3',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);

      $gallery = Gallery::findOrFail($id);

      $gallery->author = $request->author;

      if(($request->hasFile('image'))) {
        $name = md5(time()) . '.' . $request->image->getClientOriginalExtension();

        $savePath = 'storage_old/gallery/';

        if (!File::exists($savePath)) {
          File::makeDirectory($savePath, 0777, true, true);
        }

        Image::make($request->image->getRealPath())
              ->resize(1200, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path($savePath) . $name);

        $gallery->image = $name;
      }

      $gallery->save();

      $request->session()->flash('alert-success', $gallery->author . '`s image updated');
      return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $image = Gallery::findOrFail($id);

      $imagePath = public_path('storage_old/gallery/') . $image->image;
      if (File::exists($imagePath)) {
        File::delete($imagePath);
      }
      
      $image->delete();

      return redirect()->route('gallery.index')
          ->with('alert-danger', 'Image was deleted');
    }
}
