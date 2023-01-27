<?php

namespace app\Http\Traits;

use app\Models\Events\Event;

trait EventTrait {

  protected function getUnconfirmedEvents() {
    return [
        'unconfirmedEvents' => Event::where('confirmed', 0)->count()
    ];
  }
}