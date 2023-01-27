<?php

namespace app\Http\Controllers\Page\Gallery;

use app\Http\Controllers\Controller;

use app\Models\Gallery\Gallery;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
  public function index()
  {
	  $images = Cache::remember('images-gallery', 60 * 60 * 24 * 7, function () { //7days
		  $images_ = Gallery::latest()->where('image', '!=', NULL)->get();
		  $videos_ = Gallery::latest()->where('video', '!=', NULL)->get();
		  $merged = $images_->merge($videos_);

		  return $merged->all();
	  });


    return view('web.gallery.index_new')->with(['images' => $images, 'heading' => 'Galerija']);
    return view('web.gallery.index')->with(['images' => $images]);
  }
}
