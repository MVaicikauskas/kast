<?php

namespace app\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\General\PageSettings;

class PrivacyPolicyController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacy_page = PageSettings::findOrFail(2);
        return view('admin.page.general.privacy.edit')->with([
            'privacy' => $privacy_page,
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
    public function update(Request $request)
    {
        // Validate form
        $this->validate($request, [
            'title' => 'required',
            'about_us' => 'required'
        ]);
        
        // Retrieve data
        $privacy_data = PageSettings::findOrFail(2);
        $privacy_data->title = $request->title;
        $privacy_data->about_us = $request->about_us;

        $privacy_data->save();

        $request->session()->flash('alert-success', 'Page privacy information successfully updated!');
        return redirect()->back();
    }
}
