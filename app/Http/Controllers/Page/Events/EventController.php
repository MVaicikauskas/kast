<?php

namespace app\Http\Controllers\Page\Events;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

// Events
use app\Models\Events\Event;
use app\Models\Events\EventCategory;
use app\Models\Events\EventRegion;

// General models
use app\Models\General\PageSettings;
use app\Models\General\Partner;

use app\Models\Advertisement\Settings as AdvertisementSettings;
use app\Models\Advertisement\Advertisement;

use DB;

class EventController extends Controller
{
    public function events(Request $request)
    {

        $events = Event::whereDate('date','>=', date('Y-m-d'))
            ->with('category')
            ->confirmed()
            ->filters()
            ->orderBy('date', 'ASC')
            ->paginate(20);

        if( $request->ajax() ) {
            return view('web.events.partials.events-list_new')->with(['events' => $events]);
        }

        $unlimited_events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->orderByDate()->get(['date', 'title', 'slug'])->toJSON();

        return view('web.events.events_new')->with([
            'unlimited_events' => $unlimited_events,
            'events' => $events,
            'regions' => EventRegion::get(['id','slug','name']),
            'categories' => EventCategory::get(['id','slug','name']),
            'heading' => 'Renginiai'
        ]);

		/*-------------*/
		$ads = [];
		$showGoogleAds = false;

		if (AdvertisementSettings::where('page', 'events')->first()->option === 1) {
		  $ads = Advertisement::latest()->get();

		  if (sizeof($ads) > 2) {
			  $ads = $ads->random(2);
		  }
		}

		if (AdvertisementSettings::where('page', 'events')->first()->option === 2) {
		  $ads = Advertisement::where('category_id', 6)->latest()->get();
		  if (sizeof($ads) > 2) {
			  $ads = $ads->random(2);
		  }
		}

		if (AdvertisementSettings::where('page', 'events')->first()->option === 3) {
		  $showGoogleAds = true;
		}
	/*------------*/


        $new_events = Event::select('events.*', 'event_alternative_days.date as e_date', 'event_alternative_days.start_time as e_start_time', 'event_alternative_days.end_time as e_end_time', 'event_alternative_days.id as e_id' )
              ->leftJoin('event_alternative_days', 'events.id', '=', 'event_alternative_days.alternatable_day_id')
              ->where('events.date','>=', date('Y-m-d'))->confirmed()->orderBy('events.date', 'ASC')->paginate(30);

        $alternative_dates = DB::select('select alternatable_day_id from event_alternative_days where date >= now();');
        //Log::debug($alternative_dates->toSql());
        $alternative_dates = json_decode(json_encode($alternative_dates), true);
        //Log::debug($alternative_dates);
        //Log::info(print_r($alternative_dates, true));
        $eventss = Event::whereDate('date','>=', date('Y-m-d'))
                        ->orwhereraw('id in (select alternatable_day_id from event_alternative_days where date >= DATE_FORMAT(now(),"%Y%m%d")')
                        ->confirmed()
                        ->orderByDate()
                        ->orderByTime();
                        //->paginate(30);

        //  $eventss  = Event::whereDate('date','>=', date('Y-m-d'))
        //                      ->orWhereIn('id', $alternative_dates)->confirmed()
        //                      ->orderByDate()->paginate(30);
        //Log::debug($eventss->toSql());
        //Log::debug(strtotime('17:34'));
        //Log::debug($eventss);

        //Log::info(print_r($eventss  , true));


      $events = Event::whereDate('date','>=', date('Y-m-d'))
                       // ->orwhereraw('id in (select alternatable_day_id from event_alternative_days where date >= DATE_FORMAT(now(),"%Y%m%d")')
                        ->confirmed()
                        ->orderByDate()
                        ->orderByTime()
                        ->paginate(30);
      $unlimited_events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->orderByDate()->get(['date', 'title', 'slug'])->toJSON();





      if ($request->date) {
        $events = Event::confirmed()->where('date', $request->date)->paginate(30);
        $unlimited_events = Event::confirmed()->where('date', $request->date)->get(['date', 'title', 'slug'])->toJSON();
      }

        return view('web.events.events')->with([
            'page' => PageSettings::first(),
            'partners' => Partner::all(),
            'categories' => EventCategory::all(),
            'events' => $events,
            'unlimited_events' => $unlimited_events,
            'regions' => EventRegion::all(),
			'ads' => $ads,
			'googleAds' => $showGoogleAds
        ]);
    }

    public function eventsByCategory($categorySlug)
    {
        $category = EventCategory::where('slug', $categorySlug)->firstOrFail();
        $events = Event::whereDate('date','>=', date('Y-m-d'))
            ->where('category_id', $category->id)
            ->with('category')
            ->confirmed()
            ->orderBy('date', 'ASC')
            ->paginate(20);

        return view('web.events.events_new')->with([
            'events' => $events,
            'regions' => EventRegion::get(['id','slug','name']),
            'categories' => EventCategory::get(['id','slug','name']),
            'heading' => $category->name
        ]);

        if ($categorySlug !== 'all') {
            $category = EventCategory::where('slug', $categorySlug)->first();
            $events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->where('category_id', $category->id)->latest()->get();
            $unlimited_events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->where('category_id', $category->id)->latest()->get(['date', 'title', 'slug'])->toJSON();
        } else {
            $events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->get();
            $unlimited_events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->get(['date', 'title', 'slug'])->toJSON();
        }


        if (!empty($events)) {
            return view('web.events.partials.events-list')->with([
          'events' => $events,
          'unlimited_events' => $unlimited_events

            ]);
        } else {
            return response()->json([
          'status' => 'Error',
          'message' => 'No events'
        ], 409);
        }
    }

    public function event($category, $slug)
    {
        $category = EventCategory::where('slug', $category)->firstOrFail();
        $event = Event::where('category_id', $category->id)->where('slug', $slug)->firstOrFail();
        //$event->load('alternativeDate'); not using in new design and earlier

        return view('web.events.single-event_new')->with([
            'simEvents' => Event::confirmed()
                ->where('category_id', $category->id)
                ->where('id', '!=', $event->id)
                ->where('date', '>=', date('Y-m-d'))
                ->with('category')
                ->limit(3)->get(),
            'event' => $event,
            'category' => $category,
            'heading' => $category->name
        ]);

        $category = EventCategory::where('slug', $category)->first();
        $event = Event::where('category_id', $category->id)->where('slug', $slug)->first();

        //dd($event->category_id);

        $catId = $event->category_id;
        $todays_date = date('Y-m-d H:i:s');

        return view('web.events.single-event')->with([
            'page' => PageSettings::first(),
            'partners' => Partner::all(),
            'simEvents' => Event::confirmed()
                ->where('category_id', $catId)
                ->where('id', '!=', $event->id)
                ->whereDate('date', '>=', $todays_date)
                ->limit(4)->get(),
            'event' => $event
        ]);
    }

    public function filteredEvents(Request $request)
    {
        $data = [];

        if (isset($request->filter['region']) && $request->filter['region'] !== 'all') {
//            $region = EventRegion::where('slug', $request->filter['region'])->get();
            $filtered_region_id = intval($request->filter['region']);
            array_push($data, ['region_id', $filtered_region_id]);
        }

        if (isset($request->filter['category']) && $request->filter['category'] !== 'all') {
            $filtered_cat_id = intval($request->filter['category']);
//            $category = EventCategory::where('slug', $request->filter['category'])->get();
            array_push($data, ['category_id', $filtered_cat_id]);
        }

        if (isset($request->filter['price']) && $request->filter['price'] !== 'all') {
            switch ($request->filter['price']){
                case 'free':
                    array_push($data, ['is_free', 1]);
                    break;
                case 'paid':
                    array_push($data, ['is_free', 0]);
                    break;
            }
        }

        if (isset($request->filter['date']) && $request->filter['date'] > 0) {
            array_push($data, ['date', 'LIKE', '%' . $request->filter['date'] . '%']);
        }

        if (isset($request->filter['name'])) {
            array_push($data, ['title', 'LIKE', '%' . $request->filter['name'] . '%']);
        }

        if (count($data) > 0) {
            $events = Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->where($data)->orderByDate()->paginate(30);
            $unlimited_events = Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->where($data)->orderByDate(['date', 'title', 'slug'])->get(['date', 'title', 'slug'])->toJSON();

        } else {
            $events = Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->orderByDate()->paginate(30);
            $unlimited_events = Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->orderByDate()->get(['date', 'title', 'slug'])->toJSON();
        }

        if ($events->isEmpty()) {
            return view('web.events.partials.no-events');
        }

        return view('web.events.partials.events-list')->with([
            'events' => $events,
            'unlimited_events' => $unlimited_events
        ]);
    }

//    protected function getAllEvents()
//    {
//        $today = Carbon::now();
//
//        $events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->latest()->paginate(30);
//        $unlimited_events = Event::whereDate('date','>=', date('Y-m-d'))->confirmed()->latest()->get(['date', 'title', 'slug'])->toJSON();
//
//        $recomendedEvents = Event::confirmed()->recommended()->get();
//
//        $filteredEvents = [];
//
//        /**
//         * @to-do filter events by same or after today
//         */
//
//        if (count($recomendedEvents) > 0) {
//            foreach ($recomendedEvents as $event) {
//                if (count($filteredEvents) === self::SHOW_EVENTS) {
//                    break;
//                }
//
//                array_push($filteredEvents, $event);
//            }
//        }
//
//        foreach ($events as $event) {
//            if (count($filteredEvents) === self::SHOW_EVENTS) {
//                break;
//            }
//
//            array_push($filteredEvents, $event);
//        }
//
//        return $filteredEvents;
//    }
}
