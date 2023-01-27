<?php

namespace app\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

  protected $table = 'advertisement_settings';
  
  protected $fillable = ['page', 'option'];
}
