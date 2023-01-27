<?php

namespace app\Models\Activity;

use Illuminate\Database\Eloquent\Model;

class ActivityRegion extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'name',
        'slug',
    ];
}
