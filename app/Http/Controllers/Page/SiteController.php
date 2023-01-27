<?php

namespace app\Http\Controllers\Page;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

use app\Http\Requests\ContactRequest;

// General models
use app\Models\General\PageSettings;
use app\Models\General\Banner;
use app\Models\General\Partner;

// Events
use app\Models\Events\Event;
//use app\Models\Events\EventCategory;

use app\Models\Posts\Post;

// Other
use app\Models\Activity\Activity;
use app\Models\Gallery\Gallery;
use app\Models\Advertisement\Advertisement;
use app\Models\Advertisement\Settings;

use app\Models\General\ContactUs;
use app\Models\General\AboutUs;
use app\Models\Advertisement\AdvertisementPageSettings;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

//use Illuminate\Support\Facades\Date;
//use Mail;

//use app\Mail\ContactInquiry;

class SiteController extends Controller
{
  
    const SHOW_EVENTS = 4;

    private function convertDateString($date)
    {
        if (is_string($date)) {
            $date = Carbon::parse($date,new DateTimeZone('UTC +2'));
        }

        return $date;
    }

    public function index()
    {
        $images = Cache::remember('home-images-gallery', 60*60*24*31, function () {
            $images_ = Gallery::latest()->whereNotNull('image')->limit(6)->get(['id','image','author']);
            $videos_ = Gallery::latest()->whereNotNull('video')->limit(2)->get(['id','video','author']);
            return $images_->merge($videos_)->shuffle();
        });

        $events =  Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->orderByDate()
            ->with('category')->take(6)->get(['slug', 'image', 'title', 'date', 'start_time', 'location', 'category_id']);

        $activitiesChildrenCount = Cache::remember('activities-children-count', 60*60*24*31, function () {
            return Activity::where('category_id', 1)->count();
        });
        $activitiesAdultsCount = Cache::remember('activities-adults-count', 60*60*24*31, function () {
            return Activity::where('category_id', 2)->count();
        });

        $news_posts = Post::with('category')->latest()->limit(5)->get(['title', 'slug', 'category_id', 'image', 'tags', 'created_at']);
        $news_posts_all = $news_posts;
        $news_posts_first = $news_posts->first();

        return view('web.home.index_new')->with([
            'partners' => Partner::all(),
            'events' => $events,
            'activitiesChildrenCount' => $activitiesChildrenCount,
            'activitiesAdultsCount' => $activitiesAdultsCount,
            'featured_news' => Post::where('featured', 1)->with('category')->latest()->limit(3)->get(['title', 'slug', 'category_id', 'image', 'tags', 'created_at']),//first three
            'news_1' => $news_posts_all,
            'news_1_first' => $news_posts_first,
            'images' => $images
        ]);

        $settings = Settings::where('page', 'homepage')->first();

        $ads = null;
        $googleAds = false;

        if ($settings->option === 1) {
          $ads = Advertisement::latest()->get();

          if (sizeof($ads) >= 3) {
            $ads = $ads->random(3);
          }
          if (sizeof($ads) >= 5) {
            $ads = $ads->random(5);
          }
        } else if ($settings->option === 2) {
          $ads = Advertisement::where('category_id', 2)->get();

          if (sizeof($ads) >= 3) {
            $ads = $ads->random(3);
          }
          if (sizeof($ads) >= 5) {
            $ads = $ads->random(5);
          }
        } else if ($settings->option === 3) {
          $googleAds = true;
        }

        //$now = date("H:m");
        //$todays_time = date("Y-m-d H:i:s", strtotime("+2 hours", $now));
        

        $images_ = Gallery::latest()->where('image', '!=', null)->limit(3)->get();
        $videos_ = Gallery::latest()->where('video', '!=', null)->limit(1)->get();
        $merged = $images_->merge($videos_)->shuffle();
        $images = $merged->all();

        //#DK
        //Home page add after news
        $homepage_mobile_news_ad_enable = false;
        $homepage_mobile_news_ad_link = '';
        $homepage_mobile_news_ad_image = '';
        $homepage_mobile_news_ad_data = Advertisement::where('category_id', 12)->first();
        if($homepage_mobile_news_ad_data !== null){
            $homepage_mobile_news_ad_enable = date('Y-m-d') < $homepage_mobile_news_ad_data->expire_date;
            $homepage_mobile_news_ad_link = $homepage_mobile_news_ad_data->link;
            $homepage_mobile_news_ad_image = $homepage_mobile_news_ad_data->image;
        }
        return view('web.home.index')->with([
          'page' => PageSettings::first(),
          'banners' => Banner::all(),
          'partners' => Partner::all(),
          'events' => Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->orderByDate()->limit(4)->get(),
          'full_events' => Event::whereDate('date', '>=', date('Y-m-d'))->confirmed()->orderByDate()->get(),   
          'activities' => Activity::all(),
          'posts' => Post::latest()->limit(9)->get(),
          'images' => $images,
          'ads' => $ads,
          'googleAds' => $googleAds,
          'homepage_mobile_news_enable' => $homepage_mobile_news_ad_enable,
          'homepage_mobile_news_ad_url' => $homepage_mobile_news_ad_link,
          'homepage_mobile_news_ad_image' => $homepage_mobile_news_ad_image
        ]);
    }

    protected function getMonthName($month = 1)
    {
        $monthMap = [
            1 => "SA",
            2 => "VA",
            3 => "KO",
            4 => "BA",
            5 => "GE",
            6 => "BI",
            7 => "LI",
            8 => "RU",
            9 => "RU",
            10 => "SP",
            11 => "LA",
            12 => "GR",
        ];

        return $monthMap[$month];
    }

    // Contacts
    public function contacts()
    {
        return view('web.contacts.contact_new')->with([
            'contact_us' => ContactUs::firstOrFail(),
            'heading' => 'Kontaktai'
        ]);
        return view('web.contacts.contact')->with([
          'page' => PageSettings::first(),
          'partners' => Partner::all(),
          'contact_us' => ContactUs::first(),
          'about_us' => AboutUs::first(),
          'events' => Event::all()->where('confirmed', 1)
      ]);
    }

    public function aboutUs()
    {
        return view('web.aboutUs.index_new')->with([
            'about_us' => AboutUs::firstOrFail(),
            'heading' => 'Apie mus'
        ]);
        return view('web.aboutUs.index')->with([
          'page' => PageSettings::first(),
          'partners' => Partner::all(),
          'about_us' => AboutUs::first(),
          'events' => Event::all()->where('confirmed', 1)
      ]);
    }

    public function privacyPolicy()
    {
        //id=2 is for privacy page info,used old architecture.
        $privacy_page = PageSettings::findOrfail(2);

        return view('web.privacy.index_new')->with([
            'heading' => $privacy_page->title,
            'content' => $privacy_page->about_us
        ]);

        return view('web.privacy.index')->with([
          'page' => PageSettings::first(),
          'partners' => Partner::all(),
          'events' => Event::all()->where('confirmed', 1)
      ]);
    }

	public function advertisement()
    {
        $ads_page_content = AdvertisementPageSettings::firstOrFail();
        return view('web.advertisements.reklama_new')->with([
            'advertisementPageSettings' => $ads_page_content,
            'heading' => $ads_page_content->Title
        ]);
        return view('web.advertisements.reklama')->with([
          'page' => PageSettings::first(),
          'advertisementPageSettings' => AdvertisementPageSettings::first(),
          'partners' => Partner::all(),
          'events' => Event::all()->where('confirmed', 1)
      ]);
    }
}
