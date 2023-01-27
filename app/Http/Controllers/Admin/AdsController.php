<?php

namespace app\Http\Controllers\Admin;

use app\Http\Controllers\AdminController;
use app\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;
use Image;

class AdsController extends AdminController
{
    public function index() {
        $ads = Ads::latest()->get();

        return view('admin.ads.list', ['ads' => $ads, 'data' => $this->getUnconfirmedEvents()]);
    }

    public function edit($id) {
        return view('admin.ads.edit')->with([
            'ad' => Ads::findOrFail($id),
            'data'  => $this->getUnconfirmedEvents()
        ]);
    }

    public function update(Request $request, $id) {

        $messages = ['required' => 'The ":attribute" field is required.', 'required_if' => 'The ":attribute" field is required when ":other" is ":value".'];
        $this->validate($request, [
            'status' => 'required',
            'type' => 'required',
            'custom' => 'required_if:type,custom',
            'link' => 'required_if:type,image|max:191',
            'image' => 'image',
            'google' => 'required_if:type,google',
            'comments' => 'max:191'
        ],
        $messages
        );

        $ad = Ads::findOrFail($id);

        $ad->type = $request->type;
        $ad->status = $request->status;
        $ad->custom = $request->custom;
        $ad->link = $request->link;

        if(($request->hasFile('image'))) {
            $original_name                      = $request->image->getClientOriginalName();
            $original_name_without_extension    = pathinfo($original_name, PATHINFO_FILENAME);
            $name                               = Str::slug( $original_name_without_extension ) . '.' . $request->image->getClientOriginalExtension();

            $savePath = 'storage_old/ad-folder/';

            if (!File::exists($savePath)) {
                File::makeDirectory($savePath, 0777, true, true);
            }

            Image::make($request->image->getRealPath())->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path($savePath) . $name);

            $ad->image = $name;
        }

        if($request->filled('old_image')) {
            $ad->image = $request->old_image;
        }

        $ad->google = $request->google;
        $ad->comments = $request->comments;

        $ad->save();

        $request->session()
            ->flash('alert-warning', 'Ad ' . $ad->title . ' updated successfully');

        return redirect()->route('ads.index');
    }

    public function deleteFile($filename = '') {
        $file_path = public_path('storage_old/ad-folder/') . $filename;
        if( empty($filename) || !File::isFile($file_path) ) abort(404);

        File::delete($file_path);

        return response('OK', 200);
    }

    public function messages()
    {
        return [
            'status.required' => 'A title is required',
            'custom.required' => 'A message is required',
        ];
    }
}
