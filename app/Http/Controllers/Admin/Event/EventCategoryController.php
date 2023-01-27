<?php

namespace app\Http\Controllers\Admin\Event;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Events\EventCategory;
use app\Models\Events\Event;
use Illuminate\Support\Str;

class EventCategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.category.list')->with([
            'categories'    => EventCategory::all(),
            'data'          => $this->getUnconfirmedEvents()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.category.create')->with([
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
            'name' => 'required|unique:event_category'
        ]);


        $cat = new EventCategory;

        $cat->name = $request->name;
        $cat->slug = Str::slug($request->name, '-');
        $cat->excerpt = $request->excerpt;


        $cat->save();

        return redirect()->route('event-category.index')->with('alert-success', 'Added category successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('admin.events.category.delete')->with([
            'cat'   => EventCategory::findOrFail($id),
            'data'  => $this->getUnconfirmedEvents()
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
        return view('admin.events.category.edit')->with([
            'cat'   => EventCategory::findOrFail($id),
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
            'name' => 'required|unique:event_category'
        ]);


        $cat = EventCategory::findOrFail($id);

        $cat->name = $request->name;
        $cat->excerpt = $request->excerpt;


        $cat->save();

        return redirect()->route('event-category.index')->with('alert-success', 'Updated category successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = EventCategory::findOrFail($id);

        $cat->delete();

        return redirect()->route('event-category.index');
    }
}
