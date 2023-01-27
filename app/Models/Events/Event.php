<?php

namespace app\Models\Events;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{	

    protected $fillable = [
      'title',
      'slug',
      'category_id',
      'region_id',
      'is_free',
      'excerpt',
      'description',
      'image',
      'date',
      'start_time',
      'end_time',
      'location',
      'website',
      'ticket_link',
      'facebook_link',
      'recommended'
    ];

    public function comments() {
    	return $this->hasMany('app\Models\Events\EventComment');
    }

    public function category() {
    	return $this->belongsTo('app\Models\Events\EventCategory');
    }
    public function categories() {
        // return $this->morphMany('app\Models\Events\EventCategory');
          return $this->belongsToMany('app\Models\Events\EventCategory', 'events_event_category', 'event_id', 'event_category_id');
    }

    public function region() {
    	return $this->belongsTo('app\Models\Events\EventRegion');
    }

    public function media()
    {
      return $this->morphMany('app\Models\Media\Media', 'mediable');
    }

    public function alternativeDate()
    {
      return $this->morphMany('app\Models\Events\EventAlternativeDate', 'alternatable_day');
    }

    public function scopeConfirmed($query)
    {
      return $query->where('confirmed', 1);
    }

    public function scopeRecommended($query)
    {
      return $query->where('recommended', 1);
    }

    public function scopeOrderByDate($query) {
      return $query->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date', 'asc');
    }
    public function scopeOrderByTime($query) {
      return $query->whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->orderByRaw('TIME_FORMAT(start_time,"%H:%i")','asc');
    }

    public function scopeFilters($query){
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
        })->when(request()->filled('price'), function($query) {
            $query->where(function($query) {
                if (request()->input('price') !== 'all') {
                    switch ( request()->input('price')  ){
                        case 'free':
                            $query->where('is_free', 1);
                            break;
                        case 'paid':
                            $query->where('is_free', 0);
                            break;
                    }
                }
            });
        })->when(request()->filled('date'), function($query) {
            $query->where(function($query) {
                if (request()->input('date') > 0) {
                    $query->where('date', request()->input('date'));
                }
            });
        })->when(request()->filled('name'), function($query) {
            $query->where(function($query) {
                $query->where('title', 'LIKE', '%' . request()->input('name') . '%');
            });
        });
    }
    
}
