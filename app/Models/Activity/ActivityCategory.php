<?php

namespace app\Models\Activity;

use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];
}
