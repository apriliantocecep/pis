<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.location.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.location.create');
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

        $faq                     = new Location;
        $faq->name               = $data['name'];
        $faq->address            = $data['address'];
        $faq->google_map_address = $data['google_map_address'];
        $faq->google_map_embed   = $data['google_map_embed'];
        $faq->status             = $data['status'];
        $faq->image              = isset($data['image']) ? $data['image']: NULL;
        $faq->save();

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
        $location         = Location::findOrFail($id);
        $data['location'] = $location;

        return view('backend.location.edit', $data);
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

        $faq                     = Location::find($id);
        $faq->name               = $data['name'];
        $faq->address            = $data['address'];
        $faq->google_map_address = $data['google_map_address'];
        $faq->google_map_embed   = $data['google_map_embed'];
        $faq->status             = $data['status'];
        $faq->image              = isset($data['image']) ? $data['image']: NULL;
        $faq->save();

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
      $user = Location::whereIn('id', $request->input('data_ids'))
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
      $totalData     = Location::all()->count();

      # validate search request
      if ( $searchValue )
      {
        # get all user with filter
        $user = Location::where('name', 'like', '%'.$searchValue.'%')
        ->orderBy('created_at', 'desc')
        ->offset($start)
        ->limit($length)
        ->get();
      }
      else
      {
        # get all user without filter
        $user = Location::offset($start)
        ->orderBy('created_at', 'desc')
        ->limit($length)
        ->get();
      }

      # total filtered
      $totalFiltered = $user->count();

      $i = 1 + $start;
      $resource = [];
      foreach ($user as $key => $value) {

        $image = '';
        if ($value->picture) {
          $image = "
            <img style='' class='text-center img-responsive' src='".asset($value->picture->file)."' />
          ";
        }

        $resource[] = array_values([
          'image' => $image,
          'name'  => '
            <b>'.$value->name.'</b><br>
            <a href="'.route('location.edit', $value->id).'">Edit</a> | <a href="#" onclick="deleteItem('.$value->id.')" class="text-danger">Delete</a>
          ',
          'address' => $value->address,
          'status'  => $value->status,
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
