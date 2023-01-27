<?php

namespace app\Http\Controllers;

use app\Http\Controllers;

use app\Models\Events\Event;
use app\Models\Posts\Post;
use app\Models\Activity\Activity;

use app\Models\Posts\Tag;
use Illuminate\Http\Request;


class SitemapController extends Controller
{
    public function index() {

//      $renginiai = Event::all()->first();
//      $naujienos = Post::all()->first();
//      $bureliai = Activity::all()->first();

      return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
    }

    public function renginiai() {
       $renginiai = Event::latest()->get();
       return response()->view('sitemap.renginiai', [
           'renginiai' => $renginiai,
       ])->header('Content-Type', 'text/xml');
   }

   public function naujienos() {
       $naujienos = Post::all();
       return response()->view('sitemap.naujienos', [
           'naujienos' => $naujienos,
       ])->header('Content-Type', 'text/xml');
   }

   public function zymos() {
       $zymos = Tag::all();
       return response()->view('sitemap.zymos', [
           'zymos' => $zymos,
       ])->header('Content-Type', 'text/xml');
   }
   
   public function bureliai() {
       $bureliai = Activity::all();
       return response()->view('sitemap.bureliai', [
           'bureliai' => $bureliai,
       ])->header('Content-Type', 'text/xml');
   }
   public function main() {
        return response()->view('sitemap.main', [
            
        ])->header('Content-Type', 'text/xml');
    }

//    public function fb_articles() {
//        $fb_straipsniai = Post::all();
//        return response()->view('sitemap.fb_articles', [
//            'straipsniai' => $fb_straipsniai,
//        ])->header('Content-Type', 'application/xml');
//    }
   
}
