<?php

namespace app\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\General\PageSettings;
use app\Models\Events\Event;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class PageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.page.general.index')->with([
            'page' => PageSettings::first(),
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
        //
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
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $settings = new PageSettings;

        $settings->title = $request->title;
        $settings->description = $request->description;

        $settings->save();

        $request->session()->flash('alert-success', 'Page general information succesfully updated!');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Validate form
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg,ico',
            'hero_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_video' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:56000'
        ]);
        
        // Retrieve data
        $data = PageSettings::findOrFail($id);

        $data->title = $request->title;
        $data->description = $request->description;

        $data->about_us = $request->about_us;

        // Logo, favicon and video will be saved in same page
        $savePath = 'storage_old/page/';

        if (!File::exists($savePath)) {
          File::makeDirectory($savePath, 0777, true, true);
        }

        // Page Logo
        if ($request->hasFile('logo')) {
            $name = md5(time()) . '.' . $request->logo->getClientOriginalExtension();
            
            Image::make($request->logo->getRealPath())
              ->save(public_path($savePath) . $name);

            if (File::exists(public_path($savePath) . $data->logo)) {
              File::delete(public_path($savePath) . $data->logo);
            }
            
            $data->logo = $name;
        }
        
        // Favicon
        if ($request->hasFile('favicon')) {
            $name = md5(time()) . '.' . $request->favicon->getClientOriginalExtension();

            Image::make($request->favicon->getRealPath())
              ->save(public_path($savePath) . $name);

            if (File::exists(public_path($savePath) . $data->favicon)) {
              File::delete(public_path($savePath) . $data->favicon);
            }

            $data->favicon = $name;
        }
        
        // Hero Image
        if($request->hasFile('hero_image')) {
            $name = md5(time()) . '.' . $request->hero_image->getClientOriginalExtension();

            Image::make($request->hero_image->getRealPath())
              ->save(public_path($savePath) . $name);

            if (File::exists(public_path($savePath) . $data->hero_image)) {
              File::delete(public_path($savePath) . $data->hero_image);
            }

            $data->hero_image = $name;
        }

        $data->show_video = (bool) $request->show_video;
        
        // Hero Video
        if(!empty($request->file('hero_video'))) {
            $name = md5(time()) . '.' . $request->hero_video->getClientOriginalExtension();
			
			$VideoSavePath = 'storage/page/';
			
            $request->file('hero_video')->storeAs('page', $name, 'public');

            if (File::exists(public_path($VideoSavePath) . $data->hero_video)) {
              File::delete(public_path($VideoSavePath) . $data->hero_video);
            }

            $data->hero_video = $name;
        }
        
        $data->save();

        $request->session()->flash('alert-success', 'Page general information succesfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteImage($id)
    {
      $settings = PageSettings::find($id);
      $savePath = 'storage/page/';

      if (File::exists(public_path($savePath) . $settings->hero_image)) {
        File::delete(public_path($savePath) . $settings->hero_image);
      }

      $settings->hero_image = null;
      $settings->save();
    }

    public function deleteVideo($id)
    {
      $settings = PageSettings::find($id);
      $savePath = 'storage/page/';

      if (File::exists(public_path($savePath) . $settings->hero_video)) {
        File::delete(public_path($savePath) . $settings->hero_video);
      }

      $settings->hero_video = null;
      $settings->save();
    }

    public function deleteLogo($id)
    {
      $settings = PageSettings::find($id);
      $savePath = 'storage/page/';

      if (File::exists(public_path($savePath) . $settings->logo)) {
        File::delete(public_path($savePath) . $settings->logo);
      }

      $settings->logo = null;
      $settings->save();
    }

    public function deleteFavicon($id)
    {
      $settings = PageSettings::find($id);
      $savePath = 'storage/page/';

      if (File::exists(public_path($savePath) . $settings->favicon)) {
        File::delete(public_path($savePath) . $settings->favicon);
      }

      $settings->favicon = null;
      $settings->save();
    }
}
