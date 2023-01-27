<?php

namespace app\Models\General;

use Illuminate\Database\Eloquent\Model;

class PageSettings extends Model
{
    protected $table = 'page_settings';

    protected $fillable = [
      'title',
      'description',
      'about_us',
      'logo',
      'favicon',
      'hero_image',
      'hero_video',
      'show_video'
    ];
}
