<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.gallery.create');
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

        $gallery         = new Gallery;
        $gallery->name   = $data['name'];
        $gallery->status = $data['status'];
        $gallery->type   = $data['type'];
        $gallery->image  = isset($data['image']) ? $data['image']: NULL;
        $gallery->save();

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
        $gallery         = Gallery::findOrFail($id);
        $data['gallery'] = $gallery;

        return view('backend.gallery.edit', $data);
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

        $gallery         = Gallery::find($id);
        $gallery->name   = $data['name'];
        $gallery->status = $data['status'];
        $gallery->type   = $data['type'];
        $gallery->image  = isset($data['image']) ? $data['image']: NULL;
        $gallery->save();

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
      $user = Gallery::whereIn('id', $request->input('data_ids'))
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
      $totalData     = Gallery::all()->count();

      # validate search request
      if ( $searchValue )
      {
        # get all user with filter
        $user = Gallery::where('name', 'like', '%'.$searchValue.'%')
        ->orderBy('created_at', 'desc')
        ->offset($start)
        ->limit($length)
        ->get();
      }
      else
      {
        # get all user without filter
        $user = Gallery::offset($start)
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
            <a href="'.route('gallery.edit', $value->id).'">Edit</a> | <a href="#" onclick="deleteItem('.$value->id.')" class="text-danger">Delete</a>
          ',
          'type'   => $value->type,
          'status' => $value->status,
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
