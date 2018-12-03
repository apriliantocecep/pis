<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    //
    public function picture()
    {
      return $this->belongsTo(Media::class, 'image', 'id');
    }
}
