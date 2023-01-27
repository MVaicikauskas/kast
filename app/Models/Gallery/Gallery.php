<?php

namespace app\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    protected $table = 'gallery';

    

    protected $fillable = [
      'author',
      'image',
      'video'
    ];

    public static function boot() {
        parent::boot();

        //clear cache of activities count
        static::created(function () {
            Cache::forget('home-images-gallery');
            Cache::forget('images-gallery');
        });
        static::updated(function () {
            Cache::forget('home-images-gallery');
            Cache::forget('images-gallery');
        });
        static::deleted(function () {
            Cache::forget('home-images-gallery');
            Cache::forget('images-gallery');
        });
    }
}
