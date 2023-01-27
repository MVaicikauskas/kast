<?php

namespace app\Http\Controllers\Page\News;

use app\Models\Posts\Tag;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

use app\Models\Posts\Post;
// General models
use app\Models\General\PageSettings;
use app\Models\General\Partner;
use app\Models\Advertisement\Advertisement;

use app\Models\Advertisement\Settings as AdvertisementSettings;
use app\Models\Posts\PostCategory;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{


  public function index()
  {
      $posts = Post::latest()->with('category')->paginate(20);

      return view('web.posts.index_new')->with([
          'posts' => $posts,
          'heading' => 'Naujienos'
      ]);

    $ads = [];
    $showGoogleAds = false;


    if (AdvertisementSettings::where('page', 'posts')->first()->option === 1) {
      $ads = Advertisement::latest()->get();

      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'posts')->first()->option === 2) {
      $ads = Advertisement::where('category_id', 3)->latest()->get();
      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'posts')->first()->option === 3) {
      $showGoogleAds = true;
    }

    $posts = Post::latest()->with('category')->paginate(20);

    $categories = PostCategory::all();
    return view('web.posts.index')->with([
        'posts' => $posts,
        'categories' => $categories,
        'ads' => $ads,
        'googleAds' => $showGoogleAds
    ]);
  }

  public function singlePost($categorySlug, $postSlug)
  {
        $post_data = Cache::remember('cached-post-'.$postSlug, 60*60*24*7, function () use ($categorySlug, $postSlug) { //7days
            $category       = PostCategory::where('slug', $categorySlug)->firstOrFail(['id', 'name', 'slug']);
            $post           = Post::where('category_id', $category->id)->where('slug', $postSlug)->with('media')->with('post_tag')->firstOrFail();

	        $post_words     = str_word_count(strip_tags($post->description . $post->description2 . $post->description3));
	        //        $post_read_min  = floor($post_words / 220);
	        //        $post_read_sec  = floor($post_words % 220 / (220 / 60));
	        $post_read_min = round( $post_words / 200 );

            return [
                'category' => $category,
                'post' => $post,
	            'read_time' => $post_read_min < 1 ? '< 1 min.' : $post_read_min . ' min.'
            ];
        });

        $post = $post_data['post'];

        $similar_posts  = Cache::remember('similar-newest-posts_' . $post->id, 60*60*1, function () use ($post) { //1day
            //$similar_posts  = Post::whereNotIn('id', [$post->id])->where('category_id', $category->id)->latest()->take(6)->get(); now using newest post for similar, because client wants.
            return Post::whereNotIn('id', [$post->id])->with('category')->latest()->take(12)->get();
        });

		$data = [
			'post'          => $post,
			'category'      => $post_data['category'],
			'heading'       => $post_data['category']->name,
			'heading_link'  => url('naujienos', $post_data['category']->slug),
			'reading_time'  => isset($post_data['read_time']) ? '<li><i class="fa fa-eye"></i> ' . $post_data['read_time'] . ' skaitymui </li>' : ''
		];

		//split similart to two arrays, showing after post first 6, in footer other 6 newest posts.
	    $similar_posts_chunks = $similar_posts->chunk(6);

		if( isset($similar_posts_chunks[0]) ) {
			$data['similar_posts'] = $similar_posts_chunks[0];
		}else {
			$data['similar_posts'] = $similar_posts->take(6);
		}

		if( isset($similar_posts_chunks[1]) ) {
			$data['footer_news'] = $similar_posts_chunks[1];
		}

	    return view('web.posts.post_new')->with($data);

        $ads0 = [];
        $ads = [];
        $ads2 = [];
        $ads3 = [];
        $category = PostCategory::where('slug', $categorySlug)->firstOrFail();
        $post = Post::where('category_id', $category->id)->where('slug', $postSlug)->firstOrFail();
        $similar_posts = Post::whereNotIn('id', [$post->id])->where('category_id', $category->id)->with('category')->latest()->take(8)->get();
//    $similar_posts = Post::/*where('category_id', $category->id)->*/where('id', '!=' , $post->id)->latest()->take(8)->get();

        //0 advert
        $assignedAds0 = false;
        if (AdvertisementSettings::where('page', 'posts_inner0')->first()->option === 1) { //all
            $ads0 = Advertisement::latest()->get();

            if (sizeof($ads0) > 2) {
                $ads0 = $ads0->random(2);
            }
        }
        if (AdvertisementSettings::where('page', 'posts_inner0')->first()->option === 2) { //assigned
            $ads0 = Advertisement::where('category_id', 10)->latest()->get();
            if (sizeof($ads0) > 2) {
                $ads0 = $ads0->random(2);
            }
            $assignedAds0 = true;
        }
        if (AdvertisementSettings::where('page', 'posts_inner0')->first()->option === 3) { //google
            $assignedAds0 = false;
        }
        //1 advert
        $assignedAds = false;
        if (AdvertisementSettings::where('page', 'posts_inner')->first()->option === 1) { //all
            $ads = Advertisement::latest()->get();

            if (sizeof($ads) > 2) {
                $ads = $ads->random(2);
            }
        }
        if (AdvertisementSettings::where('page', 'posts_inner')->first()->option === 2) { //assigned
            $ads = Advertisement::where('category_id', 7)->latest()->get();
            if (sizeof($ads) > 2) {
                $ads = $ads->random(2);
            }
            $assignedAds = true;
        }
        if (AdvertisementSettings::where('page', 'posts_inner')->first()->option === 3) { //google
            $assignedAds = false;
        }
        //2 advert
        $assignedAds2 = false;
        if (AdvertisementSettings::where('page', 'posts_inner2')->first()->option === 1) { //all
            $ads2 = Advertisement::latest()->get();

            if (sizeof($ads2) > 2) {
                $ads2 = $ads2->random(2);
            }
        }
        if (AdvertisementSettings::where('page', 'posts_inner2')->first()->option === 2) { //assigned
            $ads2 = Advertisement::where('category_id', 8)->latest()->get();
            if (sizeof($ads2) > 2) {
                $ads2 = $ads2->random(2);
            }
            $assignedAds2 = true;
        }
        if (AdvertisementSettings::where('page', 'posts_inner2')->first()->option === 3) { //google
            $assignedAds2 = false;
        }
        //3 advert
        $assignedAds3 = false;
        if (AdvertisementSettings::where('page', 'posts_inner3')->first()->option === 1) { //all
            $ads3 = Advertisement::latest()->get();

            if (sizeof($ads) > 2) {
                $ads3 = $ads->random(2);
            }
        }
        if (AdvertisementSettings::where('page', 'posts_inner3')->first()->option === 2) { //assigned
            $ads3 = Advertisement::where('category_id', 9)->latest()->get();
            if (sizeof($ads3) > 2) {
                $ads3 = $ads->random(2);
            }
            $assignedAds3 = true;
        }
        if (AdvertisementSettings::where('page', 'posts_inner3')->first()->option === 3) { //google
            $assignedAds3 = false;
        }


        return view('web.posts.post')->with([
          'page' => PageSettings::first(),
          'partners' => Partner::all(),
          'similar_posts' => $similar_posts,
          'assignedAds0' => $assignedAds0,
          'assignedAds' => $assignedAds,
          'assignedAds2' => $assignedAds2,
          'assignedAds3' => $assignedAds3,
          'ads0' => $ads0,
          'ads' => $ads,
          'ads2' => $ads2,
          'ads3' => $ads3,
          'post' => $post
      ]);
  }

  public function filterByCategory($categorySlug)
  {
      $category = PostCategory::where('slug', $categorySlug)->firstOrFail();
      $posts = Post::where('category_id', $category->id)->latest()->paginate(10);
      $posts->load('category');
      return view('web.posts.index_new')->with([
          'posts' => $posts,
          'heading' => $category->name,
      ]);

    $ads = [];
    $showGoogleAds = false;


    if (AdvertisementSettings::where('page', 'posts')->first()->option === 1) {
      $ads = Advertisement::latest()->get();

      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'posts')->first()->option === 2) {
      $ads = Advertisement::where('category_id', 3)->latest()->get();
      if (sizeof($ads) > 2) {
          $ads = $ads->random(2);
      }
    }

    if (AdvertisementSettings::where('page', 'posts')->first()->option === 3) {
      $showGoogleAds = true;
    }

    $category = PostCategory::where('slug', $categorySlug)->firstOrFail();
    $posts = Post::where('category_id', $category->id)->latest()->paginate(10);
    $posts->load('category');

    $categories = PostCategory::all();
    return view('web.posts.index')->with([
      'posts' => $posts,
      'categories' => $categories,
      'ads' => $ads,
      'googleAds' => $showGoogleAds,
      'heading' => $category->name
    ]);
  }

  public function filteredPosts($categoryId)
  {
    $id = $categoryId;

    if (!empty($id)) {
      $posts = Post::where('category_id', $id)->latest()->get();
    }

    if (!empty($posts)) {
        return view('web.posts.partials.list')->with([
      'posts' => $posts
    ]);
    } else {
        return response()->json([
          'status' => 'Error',
          'message' => 'No posts'
        ], 409);
    }
  }

  protected function getAllPosts()
  {
    $posts = Post::latest()->get();

    foreach ($posts as $post) {
        $date = $post['created_at'];

        $post['month'] = $this->getMonthName($date->month);
        $post['day'] = $date->day;
    }

    return $posts;
  }

  public function tag(Request $request) {
      $tag = Tag::where('slug', $request->slug)->firstOrFail();
//          $tag->setRelation('posts', $tag->postTagPosts()->latest()->paginate(10));
      $posts = $tag->postTagPosts()->latest()->paginate(10);
      $posts->load('category');

      return view('web.posts.tag_new')->with([
          'tag' => $tag,
          'posts' => $posts,
          'heading' => $tag->title
      ]);

      $ads = [];
      $showGoogleAds = false;

      if (AdvertisementSettings::where('page', 'posts')->first()->option === 1) {
          $ads = Advertisement::latest()->get();

          if (sizeof($ads) > 2) {
              $ads = $ads->random(2);
          }
      }

      if (AdvertisementSettings::where('page', 'posts')->first()->option === 2) {
          $ads = Advertisement::where('category_id', 3)->latest()->get();
          if (sizeof($ads) > 2) {
              $ads = $ads->random(2);
          }
      }

      if (AdvertisementSettings::where('page', 'posts')->first()->option === 3) {
          $showGoogleAds = true;
      }

      $tag = Tag::where('slug', $request->slug)->firstOrFail();
      $tag->setRelation('posts', $tag->postTagPosts()->latest()->paginate(10));

      return view('web.posts.tag')->with([
          'tag' => $tag,
          'ads' => $ads,
          'googleAds' => $showGoogleAds
      ]);
  }
}
