<?php

namespace app\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'slug',

        'category_id',
        'subcategory_id',

        'excerpt',
        'description',
        'email',
        'phone',

        'address',
        'facebook_link',
        'website',

        'image',
        
        'recommended'
    ];

    public function category()
    {
      return $this->belongsTo('app\Models\Activity\ActivityCategory', 'category_id');
    }
    
    public function subcategory()
    {
      return $this->belongsTo('app\Models\Activity\ActivitySubCategory', 'subcategory_id');
    }

    public function region()
    {
      return $this->belongsTo('app\Models\Activity\ActivityRegion', 'region_id');
    }

    public function media()
    {
      return $this->morphMany('app\Models\Media\Media', 'mediable');
    }

    public function scopeForChildren($query)
    {
      return $query->where('category_id', 1);
    }

    public function scopeForAdults($query)
    {
      return $query->where('category_id', 2);
    }

    public function scopeFilters($query){
//        dd(request());
        return $query->when(request()->filled('region'), function($query) {
            $query->where(function($query) {
                if (request()->input('region') !== 'all') {
                    $query->where('region_id', intval(request()->input('region')));
                }
            });
        })->when(request()->filled('category'), function($query) {
            $query->where(function($query) {
                if (request()->input('category') !== 'all') {
                    $query->where('category_id', intval(request()->input('category')));
                }
            });
        })->when(request()->filled('subcategory'), function($query) {
            $query->where(function($query) {
                if (request()->input('subcategory') !== 'all') {
                    $query->where('subcategory_id', intval(request()->input('subcategory')));
                }
            });
        })->when(request()->filled('name'), function($query) {
            $query->where(function($query) {
                $query->where('name', 'LIKE', '%' . request()->input('name') . '%');
            });
        });
    }

    public static function boot() {
        parent::boot();

        //clear cache of activities count
        static::created(function () {
            Cache::forget('activities-adults-count');
            Cache::forget('activities-children-count');
        });
        static::deleted(function () {
            Cache::forget('activities-adults-count');
            Cache::forget('activities-children-count');
        });
    }
}
