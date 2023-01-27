<?php

namespace app\Http\Controllers\Admin\Advertisement;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Advertisement\Settings;

class SettingsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::all();

        return view('admin.advertisements.settings.settings', [
          'settings' => $settings,
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
        'homepage' => 'required|max:1',
        'events' => 'required|max:1',
        'posts' => 'required|max:1',
        'activities' => 'required|max:1',
        'posts_inner0' => 'required|max:1',
        'posts_inner' => 'required|max:1',
        'posts_inner2' => 'required|max:1',
        'posts_inner3' => 'required|max:1',
      ]);

      Settings::truncate();

      Settings::create([
        'page' => 'homepage',
        'option' => (int) $request->homepage
      ]);
      Settings::create([
        'page' => 'events',
        'option' => (int) $request->events
      ]);
      Settings::create([
        'page' => 'posts',
        'option' =>  $posts = (int) $request->posts
      ]);
      Settings::create([
        'page' => 'activities',
        'option' => (int) $request->activities
      ]);
      Settings::create([
        'page' => 'posts_inner0',
        'option' => (int) $request->posts_inner0
      ]);
      Settings::create([
        'page' => 'posts_inner',
        'option' => (int) $request->posts_inner
      ]);
      Settings::create([
        'page' => 'posts_inner2',
        'option' => (int) $request->posts_inner2
      ]);
      Settings::create([
        'page' => 'posts_inner3',
        'option' => (int) $request->posts_inner3
      ]);

      $settings = Settings::all();

      return view('admin.advertisements.settings.settings', [
        'settings' => $settings,
        'data' => $this->getUnconfirmedEvents()
      ]);
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
        //
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
