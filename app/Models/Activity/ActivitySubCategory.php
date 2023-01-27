<?php

namespace app\Models\Activity;

use Illuminate\Database\Eloquent\Model;

class ActivitySubCategory extends Model
{
    protected $table = 'activity_subcategories';
    
    protected $fillable = [
        'name',
        'slug'
    ];
}
