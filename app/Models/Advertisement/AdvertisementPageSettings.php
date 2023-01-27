<?php

namespace app\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;

class AdvertisementPageSettings extends Model
{
    protected $table = 'advertisement_page_settings';

    protected $fillable = [
      'Title',
      'Text',
      'Photo'
    ];
}
