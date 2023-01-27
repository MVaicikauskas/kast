<?php

namespace app\Http\Controllers\Admin;

use app\Http\Controllers\Controller;

use app\Models\Events\Event;

use app\Models\Gallery\Gallery;
use app\Models\General\Partner;

class DashboardController extends Controller
{
    public function index() {


    	$data = [
    		'confirmedEvents' => Event::where('confirmed', 1)->count(),
    		'unconfirmedEvents' => Event::where('confirmed', 0)->count(),
    		'gallery' => Gallery::count(),
    		'partners' => Partner::count(),
    	];


    	return view('admin.home.dashboard')->with('data', $data);
    }
}
