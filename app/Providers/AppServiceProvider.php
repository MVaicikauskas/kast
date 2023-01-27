<?php

namespace app\Providers;

use app\Models\Ads;
use app\Models\Posts\Post;
use app\Models\Posts\PostCategory;
use app\Models\Posts\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //load only in frontend, admin or console not needed
        if( !request()->is('admin*') && ! $this->app->runningInConsole() ) {
            $data = [
                'current_temp_klaipeda' => 0,
                'ig_likes' => 0,
                'fb_likes' => 0
            ];

            $month = date('n');
            $day = date('j');
            $month_name = [1 => 'Sausio', 2 => 'Vasario', 3 => 'Kovo', 4 => 'Balandžio', 5 => 'Gegužės', 6 => 'Birželio', 7 => 'Liepos', 8 => 'Rugpjūčio', 9 => 'Rugsėjo', 10 => 'Spalio', 11 => 'Lapkričio', 12 => 'Gruodžio'];

            $data['current_date'] = $month_name[$month] . ' ' . $day . 'd.';

            $data['current_temp_klaipeda'] = Cache::remember('current-temp-klaipeda', 60*60*1, function () { //1hour
                $client = new \GuzzleHttp\Client();

                try{
                    $weather_api_request = $client->get('http://api.weatherapi.com/v1/current.json?key=dd6f2aa3c46e4e8ab5f85644210907&q=Klaipeda&aqi=no');

                    if ( $weather_api_request->getBody()) {
                        $weather_api_data = json_decode($weather_api_request->getBody());
                        return ['temp' => $weather_api_data->current->temp_c, 'icon' => $weather_api_data->current->condition->icon];
                    }
                }catch(Exception $e) {
                    
                }

                return ['temp' => 0, 'icon' => ''];
            });

            $data['topheader_news'] = Post::where('trending', 1)->with('category')->latest()->get(['title', 'slug', 'category_id']);

            $data['post_categories'] = Cache::remember('post-categories', 60*60*24*31, function () {//used for menu only
                return PostCategory::all(['slug','name']);
            });

            $data['news_sidebar'] = Post::where('category_id',4)->latest()->limit(7)->with('category')->get(['title', 'slug', 'category_id', 'image', 'tags', 'created_at']);

            $data['footer_news'] = Post::latest()->limit(5)->with('category')->get(['title', 'slug', 'category_id', 'image', 'tags', 'created_at']);

            $data['tags_sidebar'] = Cache::remember('tags', 600, function () {
		            return Tag::inRandomOrder()->limit(10)->get(['title', 'slug']);
            });

            $ig = Cache::get('ig-likes', 13000);
            $data['ig_likes'] = ($ig > 1000) ? intval($ig/1000) . ' tūkst.' : $ig;

            $fb = Cache::get('fb-likes', 73000);
            $data['fb_likes'] = ($fb > 1000) ? intval($fb/1000) . ' tūkst.' : $fb;

            $ads_info = Cache::remember('ads-cache', 60*60*24*7, function () { //7days
                $ads_list       = Ads::where('status',1)->get(['title','type','link','image','custom','google']);
                $has_google_ad  = false;

                foreach ( $ads_list as $ad ){
                    if($ad->type == "google") $has_google_ad = true;
                }

                return ['ads_list' => $ads_list, 'has_google' => $has_google_ad];
            });
            $data['ads_list']       = $ads_info['ads_list'];
            $data['ads_has_google'] = $ads_info['has_google'];

            //Share to views
            View::share($data);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind('path.public', function() {
          return base_path().'/public_html';
        });
    }
}
