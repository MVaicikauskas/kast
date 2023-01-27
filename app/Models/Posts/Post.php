<?php

namespace app\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    protected $fillable = [
      'author',
      'name',
      'slug',
      'featured',
      'trending',
      'excerpt',
      'description',
      'image',
      'category_id',
      'tags',
      'youtube_url',
      'youtube_main'
    ];

    protected $casts = [
      'tags' => 'json'
    ];

    public function category()
    {
      return $this->belongsTo('app\Models\Posts\PostCategory', 'category_id');
    }

    public function media()
    {
      return $this->morphMany('app\Models\Media\Media', 'mediable');
    }

    public function post_tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tags_relation', 'post_id');
    }

    public static function boot() {
        parent::boot();

        //clear cache of similar-newest-posts
        static::created(function (Post $post) {
	        Cache::forget('similar-newest-posts_' . $post->id );
        });
        static::updated(function (Post $post) {
            Cache::forget('similar-newest-posts_' . $post->id );
            Cache::forget('cached-post-'.$post->slug);
        });
        static::deleted(function (Post $post) {
	        Cache::forget('similar-newest-posts_' . $post->id );
        });
    }
}
