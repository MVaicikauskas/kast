<?php

namespace app\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\General\SocialMedia;
use app\Models\Events\Event;
use Illuminate\Support\Facades\Cache;

class SocialMediaController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $social = SocialMedia::first();

        if(empty($social)) {
            $social['id'] = 1;
            $social['facebook'] = '';
            $social['instagram'] = '';
            $social['youtube'] = '';
        }

        return view('admin.page.general.social.list')->with([
            'social' => $social,
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
        //
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
        $request->validate([
            'facebook' => 'required|int',
            'instagram' => 'required|int'
        ]);

        $social = SocialMedia::find($id);

       if(!$social) {
           $new_social = new SocialMedia;
           $new_social->facebook = $request->facebook;
           $new_social->instagram = $request->instagram;
           $new_social->save();
       }
       else {
           $social->facebook = $request->facebook;
           $social->instagram = $request->instagram;
           $social->save();
       }

       //store count to cache
        Cache::forget('ig-likes');
        Cache::forget('fb-likes');
        Cache::forever('ig-likes', $request->instagram);
        Cache::forever('fb-likes', $request->facebook);

        $request->session()->flash('alert-success', 'Social media stats updated manually');
        return redirect()->route('social.index');
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
}
