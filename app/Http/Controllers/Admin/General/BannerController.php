<?php

namespace app\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\General\Banner;
use app\Models\Events\Event;

class BannerController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page.general.banners.list')->with([
            'banners' => Banner::all(),
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
        return view('admin.page.general.banners.create')->with([
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
            'name' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $banner = new Banner;

        $banner->name = $request->name;

        if(!empty($request->link)) {
            $banner->link = $request->link;
        }

        $name = md5(time()) . '.' . $request->banner->getClientOriginalExtension();
        $request->banner->storeAs('banners', $name, 'public');
        $banner->banner = $name;

        $banner->save();

        return redirect()->route('banner.index')->with('alert-success', 'Added banner successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.page.general.banners.delete')->with([
            'banner'   => Banner::findOrFail($id),
            'data'     => $this->getUnconfirmedEvents()
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
        return view('admin.page.general.banners.edit')->with([
            'banner'   => Banner::findOrFail($id),
            'data'     => $this->getUnconfirmedEvents()
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
            'name' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $banner = Banner::findOrFail($id);

        $banner->name = $request->name;

        if(!empty($request->link)) {
            $banner->link = $request->link;
        }

        if(!empty($request->banner)) {
            $name = md5(time()) . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->storeAs('banners', $name, 'public');
            $banner->banner = $name;
        }
        $banner->save();

        return redirect()->route('banner.index')->with('alert-warning', 'Updated banner successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        $banner->delete();

        return redirect()->route('banner.index')->with('alert-danger', 'Deleted banner successfuly');
    }
}
