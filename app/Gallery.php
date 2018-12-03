<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    public function scopeActive($query)
    {
      return $query->where('status', 'active');
    }

    public function scopeOfType($query, $type='kajian')
    {
      return $query->where('type', $type);
    }

    public function picture()
    {
      return $this->belongsTo(Media::class, 'image', 'id');
    }
}
