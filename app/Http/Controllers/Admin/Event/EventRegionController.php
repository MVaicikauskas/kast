<?php

namespace app\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Events\EventRegion;
use app\Models\Events\Event;
use Illuminate\Support\Str;

class EventRegionController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.region.list')->with([
            'regions' => EventRegion::all(),
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
        return view('admin.events.region.create')->with([
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
            'name' => 'required|unique:event_regions'
        ]);

        EventRegion::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('event-region.index')->with('alert-success', 'Created region successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.events.region.delete')->with([
            'data' => $this->getUnconfirmedEvents(),
            'region' => EventRegion::findOrFail($id)
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
        return view('admin.events.region.edit')->with([
            'data' => $this->getUnconfirmedEvents(),
            'region' => EventRegion::findOrFail($id)
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
            'name' => 'required|unique:event_region'
        ]);

        EventRegion::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('event-region.index')->with('alert-success', 'Updated region successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EventRegion::findOrFail($id)->delete();

        return redirect()->route('event-region.index');
    }
}