<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    //
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'date_from',
        'date_to'
    ];

    // public function getDateFromAttribute()
    // {
    //   // return \Carbon\Carbon::parse($this->attributes['date_from'], 'Asia/Jakarta')->format('l, d F Y @H:i');
    //   return $this->attributes['date_from'];
    // }

    public function scopeActive($query)
    {
      return $query->where('status', 'active');
    }

    public function scopeThisMonth($query)
    {
      return $query->whereMonth('date_from', date('m'));
    }

    public function scopeThisWeekend($query)
    {
      // $now = new Carbon('2018-12-01 22:40:10.1');
      $now = Carbon::now();
      // dd($now->endOfWeek()->format('Y-m-d'));
      $date_of_this_weekend = $now->nextWeekendDay()->format('Y-m-d');
      
      return $query->whereDate('date_from', $date_of_this_weekend);
    }

    public function scopeOfMonth($query, $month='')
    {
      return $query->whereMonth('date_from', $month ? $month: date('m'));
    }

    public function picture()
    {
      return $this->belongsTo(Media::class, 'image', 'id');
    }

    public function location()
    {
      return $this->belongsTo(Location::class);
    }

    public function sponsor()
    {
      return $this->belongsTo(Sponsor::class);
    }

    public function speaker()
    {
      return $this->belongsTo(Speaker::class);
    }

    public function faq()
    {
      return $this->belongsTo(Faq::class);
    }
}
