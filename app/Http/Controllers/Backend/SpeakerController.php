<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Speaker;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.speaker.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.speaker.create');
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

        $faq              = new Speaker;
        $faq->name        = $data['name'];
        $faq->slug        = str_slug($data['name']);
        $faq->description = $data['description'];
        $faq->address     = $data['address'];
        $faq->ig_url      = $data['ig_url'];
        $faq->image       = isset($data['image']) ? $data['image']: NULL;
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
        $speaker         = Speaker::findOrFail($id);
        $data['speaker'] = $speaker;

        return view('backend.speaker.edit', $data);
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

        $faq              = Speaker::find($id);
        $faq->name        = $data['name'];
        $faq->slug        = str_slug($data['name']);
        $faq->description = $data['description'];
        $faq->address     = $data['address'];
        $faq->ig_url      = $data['ig_url'];
        $faq->image       = isset($data['image']) ? $data['image']: NULL;
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
      $user = Speaker::whereIn('id', $request->input('data_ids'))
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
      $totalData     = Speaker::all()->count();

      # validate search request
      if ( $searchValue )
      {
        # get all user with filter
        $user = Speaker::where('name', 'like', '%'.$searchValue.'%')
        ->orderBy('created_at', 'desc')
        ->offset($start)
        ->limit($length)
        ->get();
      }
      else
      {
        # get all user without filter
        $user = Speaker::offset($start)
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
            <a href="'.route('speaker.edit', $value->id).'">Edit</a> | <a href="#" onclick="deleteItem('.$value->id.')" class="text-danger">Delete</a>
          ',
          'address' => str_limit($value->address, 100, '...'),
          'ig'      => $value->ig_url ? '<a href="'.$value->ig_url.'" target="_blank">Open Instagram</a>': ''
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
