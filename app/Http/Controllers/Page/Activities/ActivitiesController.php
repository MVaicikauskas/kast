<?php

namespace app\Http\Controllers\Page\Activities;

use app\Models\Activity\ActivityRegion;
use app\Http\Controllers\Controller;

use app\Models\Activity\Activity;
use app\Models\Activity\ActivitySubCategory;
use app\Models\Advertisement\Advertisement;

use app\Models\Advertisement\Settings as AdvertisementSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ActivitiesController extends Controller
{
  public function index()
  {
      $activitiesChildrenCount = Cache::remember('activities-children-count', 604800, function () {
          return Activity::where('category_id', 1)->count();
      });
      $activitiesAdultsCount = Cache::remember('activities-adults-count', 604800, function () {
          return Activity::where('category_id', 2)->count();
      });

      return view('web.activities.index_new')->with([
          'heading' => 'Būreliai',
          'activitiesAdultsCount' => $activitiesAdultsCount,
          'activitiesChildrenCount' => $activitiesChildrenCount
      ]);

    $ads = [];
    $showGoogleAds = false;

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 1) {
      $ads = Advertisement::latest()->get();

      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 2) {
      $ads = Advertisement::where('category_id', 4)->latest()->get();
      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 3) {
      $showGoogleAds = true;
      $ads = [];
    }

    $activities = Activity::latest()->paginate(30);
    return view('web.activities.index')->with([
      'activities' => $activities,
      'ads' => $ads,
      'googleAds' => $showGoogleAds
    ]);
  }

  public function activitiesForChildrenPage(Request $request)
  {
      $activities = Activity::Where('category_id', 1)->where('region_id', 1)->latest()->filters()->paginate(20);
      $activities->load(['category','subcategory']);

      if ($activities->isEmpty()) {
          return view('web.activities.partials.no-activities');
      }

      if( $request->ajax() ) {
          return view('web.activities.partials.list_new')->with(['activities' => $activities]);
      }

      return view('web.activities.categoryIndex_new')->with([
          'activities' => $activities,
          'heading' => 'Vaikams ir jaunimui',
          'activity_cat_id' => 1,
          'activity_route' => route('activities.forChildren'),
          'regions' => ActivityRegion::get(['id','slug','name']),
          'subcategories' => ActivitySubCategory::get(['id','slug','name'])
      ]);

    $showGoogleAds = false;
    if (AdvertisementSettings::where('page', 'activities')->first()->option === 1) {
      $ads = Advertisement::latest()->get();

      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 2) {
      $ads = Advertisement::where('category_id', 4)->latest()->get();
      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 3) {
      $showGoogleAds = true;
      $ads = [];
    }

    //$activities = Activity::forChildren()->latest()->paginate(30);
    $activities = Activity::Where('category_id', 1)->where('region_id', 1)->latest()->paginate(20);
    $subcategories = ActivitySubCategory::all();



    return view('web.activities.categoryIndex')->with([
      'activities' => $activities,
      'subcategories' => $subcategories,
      'googleAds' => $showGoogleAds,
      'ads' => $ads
    ]);
  }

  public function activitiesForAdultsPage(Request $request)
  {
	  $activities = Activity::Where('category_id', 2)->where('region_id', 1)->latest()->filters()->paginate(20);
	  $activities->load(['category','subcategory']);

	  if ($activities->isEmpty()) {
	      return view('web.activities.partials.no-activities');
	  }

	  if( $request->ajax() ) {
	      return view('web.activities.partials.list_new')->with(['activities' => $activities]);
	  }

	  return view('web.activities.categoryIndex_new')->with([
	      'activities' => $activities,
	      'heading' => 'Suaugusiems',
	      'activity_cat_id' => 2,
	      'activity_route' => route('activities.forAdults'),
	      'regions' => ActivityRegion::get(['id','slug','name']),
	      'subcategories' => ActivitySubCategory::get(['id','slug','name'])
	  ]);

    $showGoogleAds = false;
    if (AdvertisementSettings::where('page', 'activities')->first()->option === 1) {
      $ads = Advertisement::latest()->get();

      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 2) {
      $ads = Advertisement::where('category_id', 4)->latest()->get();
      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'activities')->first()->option === 3) {
      $showGoogleAds = true;
      $ads = [];
    }
    
	//$activities = Activity::forAdults()->latest()->paginate(30);
    $activities = Activity::where('category_id', 2)->where('region_id', 1)->latest()->paginate(30);
    $subcategories = ActivitySubCategory::all();

    return view('web.activities.categoryIndex')->with([
      'activities' => $activities,
      'subcategories' => $subcategories,
      'googleAds' => $showGoogleAds,
      'ads' => $ads
    ]);
  }

  public function singleActivity($categorySlug, $subcategorySlug, $activitySlug)
    {

        $cat_id     = $categorySlug === "suaugusiems" ? 2 : 1;

        return view('web.activities.single_new')->with([
            'activity'      => Activity::where(['slug' => $activitySlug, 'category_id' => $cat_id])->with('media', 'region', 'category','subcategory')->firstOrFail(),
            'heading'       => $categorySlug === "suaugusiems" ? "Suaugusiems" : "Vaikams ir jaunimui",
            'heading_link'  => url('bureliai/' . $categorySlug)
        ]);

        $ads = Advertisement::latest()->get();
        if (sizeof($ads) > 3) {
            $ads = $ads->random(3);
        }
        if ($categorySlug == 'suaugusiems') {
            $activity = Activity::where(['slug' => $activitySlug, 'category_id' => 2])->first();
        } else {
            $activity = Activity::where(['slug' => $activitySlug, 'category_id' => 1])->first();
        }

        return view('web.activities.single')->with([
            'activity' => $activity,
            'ads' => $ads
        ]);
    }

  public function filteredChildActivities($categoryId)
  {

        $categories = ActivitySubCategory::all();
        $category = ActivitySubCategory::find($categoryId);
//dd($categoryId );
        if ($categoryId == 10)
        {
          $activities = Activity::where('subcategory_id', $category->id)->where('category_id', 1)->where('region_id', 2)->latest()->paginate(30);
        }
        else 
        {
          $activities = Activity::where('subcategory_id', $category->id)->where('category_id', 1)->where('region_id', 1)->latest()->paginate(30);
        }
        

      return view('web.activities.partials.list')->with([
        'activities' => $activities
      ]);

  }

  public function filteredAdultActivities($categoryId)
  {
    $categories = ActivitySubCategory::all();
    $category = ActivitySubCategory::find($categoryId);

    if ($categoryId == 10)
        {
          $activities = Activity::where('subcategory_id', $category->id)->where('category_id', 2)->where('region_id', 2)->latest()->paginate(30);
        }
        else 
        {
          $activities = Activity::where('subcategory_id', $category->id)->where('category_id', 2)->where('region_id', 1)->latest()->paginate(30);
        }

    return view('web.activities.partials.list')->with([
      'activities' => $activities
    ]);
  }
}
