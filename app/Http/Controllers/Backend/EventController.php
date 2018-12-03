<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Location;
use App\Speaker;
use App\Sponsor;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $locations         = Location::active()->get();
        $data['locations'] = $locations;

        $speakers         = Speaker::all();
        $data['speakers'] = $speakers;

        $sponsors         = Sponsor::all();
        $data['sponsors'] = $sponsors;

        return view('backend.event.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $event              = new Event;
        $event->name        = $data['name'];
        $event->slug        = str_slug($data['name']);
        $event->description = $data['description'];
        $event->date_from   = date('Y-m-d H:i:s', strtotime($data['date_from_date']." ".$data['date_from_time']));
        $event->date_to     = date('Y-m-d H:i:s', strtotime($data['date_to_date']." ".$data['date_to_time']));
        $event->description = $data['description'];
        $event->url         = $data['url'];
        $event->video_url   = $data['video_url'];

        $event->location_id = $data['location_id'];
        $event->speaker_id  = $data['speaker_id'];
        $event->sponsor_id  = $data['sponsor_id'];

        $event->status      = $data['status'];
        $event->type        = "kajian";
        $event->image       = isset($data['image']) ? $data['image']: NULL;
        $event->save();

        return redirect()->back()->with('success', 'Data added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $locations         = Location::active()->get();
        $data['locations'] = $locations;

        $speakers         = Speaker::all();
        $data['speakers'] = $speakers;

        $sponsors         = Sponsor::all();
        $data['sponsors'] = $sponsors;

        $event         = Event::find($id);
        $data['event'] = $event;

        return view('backend.event.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        $event              = Event::find($id);
        $event->name        = $data['name'];
        $event->slug        = str_slug($data['name']);
        $event->description = $data['description'];
        $event->date_from   = date('Y-m-d H:i:s', strtotime($data['date_from_date']." ".$data['date_from_time']));
        $event->date_to     = date('Y-m-d H:i:s', strtotime($data['date_to_date']." ".$data['date_to_time']));
        $event->description = $data['description'];
        $event->url         = $data['url'];
        $event->video_url   = $data['video_url'];

        $event->location_id = $data['location_id'];
        $event->speaker_id  = $data['speaker_id'];
        $event->sponsor_id  = $data['sponsor_id'];

        $event->status      = $data['status'];
        $event->type        = "kajian";
        $event->image       = isset($data['image']) ? $data['image']: NULL;
        $event->save();

        return redirect()->back()->with('success', 'Data updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
      $user = Event::whereIn('id', $request->input('data_ids'))
      ->delete();
    }

    public function datatable(Request $request)
    {
      # retrive request
      $searchValue = $request->input('search.value');
      $start       = $request->input('start');
      $length      = $request->input('length');
      $draw        = $request->input('draw');

      # total data
      $totalData     = Event::all()->count();

      # validate search request
      if ( $searchValue )
      {
        # get all user with filter
        $user = Event::where('name', 'like', '%'.$searchValue.'%')
        ->orderBy('created_at', 'desc')
        ->offset($start)
        ->limit($length)
        ->get();
      }
      else
      {
        # get all user without filter
        $user = Event::offset($start)
        ->orderBy('created_at', 'desc')
        ->limit($length)
        ->get();
      }

      # total filtered
      $totalFiltered = $user->count();

      $i = 1 + $start;
      $resource = [];
      foreach ($user as $key => $value) {

        $image = '&mdash;';
        if ($value->picture) {
          $image = "
            <img style='' class='text-center img-responsive' src='".asset($value->picture->file)."' />
          ";
        }

        $resource[] = array_values([
          'image' => $image,
          'name'  => '
            <b>'.$value->name.'</b><br>
            <a href="'.route('event.edit', $value->id).'">Edit</a> | <a href="#" onclick="deleteItem('.$value->id.')" class="text-danger">Delete</a>
          ',
          // 'date'     => $value->date_from->diffForHumans(),
          'date'     => $value->date_from->format('l, d F Y @H:i A'),
          'location' => $value->location ? $value->location->name: '&mdash;',
          'speaker'  => $value->speaker ? $value->speaker->name: '&mdash;',
          'status'   => $value->status,
        ]);
      }

      $output = [
        "draw"            => $draw,
        "recordsTotal"    => $totalData,
        "recordsFiltered" => ($start || $searchValue) ? ($searchValue) ? $totalFiltered:$totalData : $totalData,
        "data"            => $resource,
        "request"         => $request->all(),
      ];

      return response()->json($output);
    }
}
