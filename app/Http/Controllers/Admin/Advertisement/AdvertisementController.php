<?php

namespace app\Http\Controllers\Admin\Advertisement;

use Illuminate\Http\Request;
use app\Http\Controllers\AdminController;

use app\Models\Advertisement\Advertisement;
use app\Models\Advertisement\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Image;

class AdvertisementController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Advertisement::latest()->get();

        return view('admin.advertisements.list', [
            'ads' => $ads,
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
        return view('admin.advertisements.create')->with([
            'data' => $this->getUnconfirmedEvents(),
            'categories' => Category::all()
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
          'client' => 'required',
          'link' => 'required',
          'expire_date' => 'required',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $advertisement = new Advertisement;

        $advertisement->client = $request->client;
        $advertisement->link = $request->link;
        $advertisement->expire_date = $request->expire_date;
        $advertisement->paid = $request->paid;

        $advertisement->category_id = $request->category_id;

        if(($request->hasFile('image'))) {
          $name = md5(time()) . '.' . $request->image->getClientOriginalExtension();

          $savePath = 'storage_old/ad-folder/';

          if (!File::exists($savePath)) {
            File::makeDirectory($savePath, 0777, true, true);
          }

          Image::make($request->image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($savePath) . $name);

          $advertisement->image = $name;
        }
        $advertisement->save();

        $request->session()->flash('alert-success', 'New advertisement added');
        return redirect()->route('advertisements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('admin.advertisements.delete')->with([
        'ad' => Advertisement::findOrFail($id),
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
      return view('admin.advertisements.edit')->with([
        'ad' => Advertisement::findOrFail($id),
        'data'  => $this->getUnconfirmedEvents(),
        'categories' => Category::all()
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
        'client' => 'required',
        'link' => 'required',
        'expire_date' => 'required'
      ]);

      $advertisement = Advertisement::findOrFail($id);

      $advertisement->client = $request->client;
      $advertisement->link = $request->link;
      $advertisement->expire_date = $request->expire_date;
      $advertisement->paid = $request->paid;

      $advertisement->category_id = $request->category_id;
      
      if(($request->hasFile('image'))) {
        $name = md5(time()) . '.' . $request->image->getClientOriginalExtension();

        $savePath = 'storage_old/ad-folder/';

        if (!File::exists($savePath)) {
          File::makeDirectory($savePath, 0777, true, true);
        }

        Image::make($request->image->getRealPath())
              ->resize(1200, null, function ($constraint) {
                  $constraint->aspectRatio();
              })
              ->save(public_path($savePath) . $name);

        $advertisement->image = $name;
      }
      $advertisement->save();

      $request->session()
        ->flash('alert-warning', 'Ad updated successfully');

      return redirect()->route('advertisements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $imagePath = public_path('storage_old/ad-folder/') . $advertisement->image;
        if (File::exists($imagePath)) {
          File::delete($imagePath);
        }

        $advertisement->delete();

        return redirect()->route('advertisements.index')
          ->with('alert-danger', 'Ad was deleted');
    }
}
