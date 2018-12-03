<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Media;
use App\Faq;
use App\Speaker;
use App\Sponsor;
use App\Location;
use App\Event;
use App\Gallery;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs         = Faq::active()->orderBy('created_at', 'DESC')->get();
        $data['faqs'] = $faqs;

        $speakers         = Speaker::all();
        $data['speakers'] = $speakers;

        $sponsors         = Sponsor::active()->orderBy('created_at', 'ASC')->get();
        $data['sponsors'] = $sponsors;

        $locations         = Location::active()->orderBy('created_at', 'ASC')->get();
        $data['locations'] = $locations;

        $events         = Event::active()->thisMonth()->orderBy('date_from', 'ASC')->get();
        $data['events'] = $events;
        // dd($events);

        # tampilkan kajian minggu ini dibulan sekarang
        $event_this_weekend = Event::thisWeekend()->first();
        $data['event_this_weekend'] = $event_this_weekend;
        // dd($event_this_weekend);

        $galleries         = Gallery::active()->ofType('kajian')->orderBy('created_at', 'ASC')->limit(30)->get();
        $data['galleries'] = $galleries;

        # gallery location
        $galleries_location         = Gallery::active()->ofType('location')->orderBy('created_at', 'ASC')->limit(8)->get();
        $data['galleries_location'] = $galleries_location;

        return view('frontend.home', $data);
    }
}
