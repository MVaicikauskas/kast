<?php

namespace app\Models\General;

use Illuminate\Database\Eloquent\Model;


class ContactUs extends Model
{
    protected $table = 'contact_us_details';

    protected $fillable = [
      'Email',
      'Phone',
      'Address',
      'Text'
    ];
}
