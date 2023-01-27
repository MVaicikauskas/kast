<?php

namespace app\Models\Events;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{

	protected $table = 'event_category';

	public function events() {
          return $this->belongsToMany('app\Models\Events\Event', 'events_event_category');
    }

}
