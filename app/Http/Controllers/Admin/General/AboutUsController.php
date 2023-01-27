<?php

namespace app\Http\Controllers\Admin\General;


use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Events\Event;
use app\Models\General\AboutUs;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class AboutUsController extends AdminController
{
    public function index()
    {
        $about_us = AboutUs::first();

        return view('admin.page.general.aboutus.edit')->with([
            'about_us' => $about_us,
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

        $about_us = AboutUs::findOrFail($id);
        
        $about_us->Title = $request->Title;
        $about_us->Text = $request->Text;

        $savePath = 'storage_old/aboutus/';

        if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
        }

        // About us Page Photo
        if ($request->hasFile('Photo')) {
            $name = md5(time()) . '.' . $request->Photo->getClientOriginalExtension();
            
            Image::make($request->Photo->getRealPath())
              ->save(public_path($savePath) . $name);

            if (File::exists(public_path($savePath) . $about_us->Photo)) {
              File::delete(public_path($savePath) . $about_us->Photo);
            }
            
            $about_us->Photo = $name;
        }


        $about_us->save();

        $request->session()->flash('alert-success', 'About us page updated');
        return redirect()->back();
    }
}
