<?php

namespace app\Models\General;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'table_about_us_details';

    protected $fillable = [
      'Title',
      'Text',
      'Photo'
    ];
}
