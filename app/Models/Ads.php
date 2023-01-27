<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Ads extends Model
{
    protected $table = 'ads';

    protected $fillable = [
        'title',
        'status',
        'type'
    ];

    protected $dates = [
        'comment'
    ];

    public static function boot() {
        parent::boot();

        //clear cache of ads-cache
        static::updated(function () {
            Cache::forget('ads-cache');
        });
    }
}
