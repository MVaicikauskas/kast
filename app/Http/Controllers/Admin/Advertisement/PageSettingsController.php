<?php

namespace app\Http\Controllers\Admin\Advertisement;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Advertisement\AdvertisementPageSettings;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;


class PageSettingsController extends AdminController
{
    public function index()
    {
        $advertisementPageSettings = AdvertisementPageSettings::first();

        return view('admin.advertisements.settings.page_settings')->with([
            'advertisementPageSettings' => $advertisementPageSettings,
            'data' => $this->getUnconfirmedEvents()
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Title' => 'required',
            'Text' => 'required',
            'Photo' => 'image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:1024'
        ]); 
        
        $advertisementPageSettings = AdvertisementPageSettings::findOrFail($id);
        
        $advertisementPageSettings->Title = $request->Title;
        $advertisementPageSettings->Text = $request->Text;
        
        $savePath = 'storage_old/adverts/';

        if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
        }

        // Adverts Page Photo
        if ($request->hasFile('Photo')) {
            $name = md5(time()) . '.' . $request->Photo->getClientOriginalExtension();
            
            Image::make($request->Photo->getRealPath())
              ->save(public_path($savePath) . $name);

            if (File::exists(public_path($savePath) . $advertisementPageSettings->Photo)) {
              File::delete(public_path($savePath) . $advertisementPageSettings->Photo);
            }
            
            $advertisementPageSettings->Photo = $name;
        }

        $advertisementPageSettings->save();

        $request->session()->flash('alert-success', 'Advertisements page updated');
        return redirect()->back();
    }

    /*public function update(Request $request, $id)
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
    }*/

}
