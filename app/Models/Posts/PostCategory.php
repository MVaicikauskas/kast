<?php

namespace app\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostCategory extends Model
{

    protected $table = 'post_categories';

    protected $fillable = [
        'name',
        'slug',
        'excerpt'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->slug);

            $latestSlug =
                static::whereRaw("slug = '$model->slug' or slug LIKE '$model->slug-%'")
                    ->latest('id')
                    ->value('slug');
            if ($latestSlug) {
                $pieces = explode('-', $latestSlug);

                $number = intval(end($pieces));

                $model->slug .= '-' . ($number + 1);
            }
        });

        //clear cache of post-categories, used for menu only
        static::created(function () {
            Cache::forget('post-categories');
        });
        static::updated(function () {
            Cache::forget('post-categories');
        });
        static::deleted(function () {
            Cache::forget('post-categories');
        });

    }
}
