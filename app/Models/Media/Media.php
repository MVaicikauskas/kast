<?php

namespace app\Models\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
      'mediable_type',
      'mediable_id',
      
      'name',
      'path',
      'extension',
      'filesize'
    ];

    public function mediable()
    {
      return $this->morphTo();
    }
}
