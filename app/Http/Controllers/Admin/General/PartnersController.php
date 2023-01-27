<?php

namespace app\Http\Controllers\Admin\General;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\General\Partner;
use app\Models\Events\Event;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class PartnersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.page.general.partners.list')->with([
            'partners' => Partner::all(),
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
        return view('admin.page.general.partners.create')->with([
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
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $partner = new Partner();

        $partner->name = $request->name;

        if(!empty($request->link)) {
            $partner->link = $request->link;
        }

        if(($request->hasFile('logo'))) {
          $name = md5(time()) . '.' . $request->logo->getClientOriginalExtension();

          $savePath = 'storage/partners/';

          if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
          }

          Image::make($request->logo->getRealPath())
              ->resize(400, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path($savePath) . $name);

          $partner->logo = $name;
        }
        $partner->save();

        $request->session()->flash('alert-success', 'Added new partner successfuly');
        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.page.general.partners.delete')->with([
            'partner' => Partner::findOrFail($id),
            'data' => $this->getUnconfirmedEvents()
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
        return view('admin.page.general.partners.edit')->with([
            'partner' => Partner::findOrFail($id),
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $partner = Partner::findOrFail($id);

        $partner->name = $request->name;

        if(!empty($request->link)) {
            $partner->link = $request->link;
        }

        if(($request->hasFile('logo'))) {
          $name = md5(time()) . '.' . $request->logo->getClientOriginalExtension();

          $savePath = 'storage/partners/';

          if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
          }

          Image::make($request->logo->getRealPath())
              ->resize(400, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path($savePath) . $name);

          $partner->logo = $name;
        }

        $partner->save();

        $request->session()->flash('alert-success', 'Updated partner successfuly');
        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        $partner->delete();

        return redirect()->route('partners.index')->with('alert-danger', 'Deleted partner successfuly');

    }
}
