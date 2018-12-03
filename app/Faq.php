<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    public function scopeActive($query)
    {
      return $query->where('status', 'active');
    }
}
