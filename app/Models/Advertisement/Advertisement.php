<?php

namespace app\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public $timestamps = false;
    protected $table = 'advertisement';

    protected $fillable = [
        'client',
        'link',
        'image',
        'expire_date',
        'paid',
        'category_id'
    ];

    protected $dates = [
      'expire_date'
    ];

    public function categories() {
    	return $this->hasOne('app\Models\Advertisement\Category', 'id', 'category_id');
    }
}
