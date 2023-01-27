<?php

namespace app\Models\Events;

use Illuminate\Database\Eloquent\Model;

class EventRegion extends Model
{
    protected $table = 'event_regions';

    protected $fillable = [
        'name',
        'slug',
    ];
}
