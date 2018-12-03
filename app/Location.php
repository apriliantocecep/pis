<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    public function scopeActive($query)
    {
      return $query->where('status', 'active');
    }

    public function picture()
    {
      return $this->belongsTo(Media::class, 'image', 'id');
    }
}
