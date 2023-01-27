<?php

namespace app\Models\Events;

use Illuminate\Database\Eloquent\Model;

class EventSlider extends Model
{
    
	protected $table = 'event_slider';
	
	public function event() {
		return $this->hasOne('app\Models\Events\Event');
	}

}
