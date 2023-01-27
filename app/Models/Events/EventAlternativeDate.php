<?php

namespace app\Models\Events;

use Illuminate\Database\Eloquent\Model;

class EventAlternativeDate extends Model
{
    protected $table = 'event_alternative_days';

    protected $fillable = [
      'alternatable_day_type',
      'alternatable_day_id',
      
      'date',
      'start_time',
      'end_time'
    ];

    public function alternatableDays()
    {
      return $this->morphTo();
    }
}
