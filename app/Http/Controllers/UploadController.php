<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Fileuploader;
use App\Media;

class UploadController extends Controller
{
    private $upload;

    //
    public function __construct()
    {
        $this->upload = new Fileuploader('files', array(
          // 'uploadDir'  => "public/media/",
          'title'      => 'auto',
          'limit'      => 20,
          // 'maxSize' => null,
    	    'fileMaxSize'=> 10, // mb
          'extensions' => ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'],
          'required'   => true,
        ));
    }

    public function up()
    {
      // call to upload the files
      $data = $this->upload->upload();

      if($data['isSuccess'] && count($data['files']) > 0) {
        $fileList = $this->upload->getFileList();

        foreach ($fileList as $key => $file) {
          $media            = new Media;
          $media->name      = $file['name'];
          $media->title     = $file['title'];
          $media->old_name  = $file['old_name'];
          $media->old_title = $file['old_title'];
          $media->extension = $file['extension'];
          $media->file      = $file['file'];
          $media->size      = $file['size'];
          $media->size2     = $file['size2'];
          $media->type      = $file['type'];
          $media->save();
        }
      }

      return $data;
    }

    public function down(Request $request)
    {
      $data = $request->all();

      if (isset($data['file'])) {
  		    $file = public_path().'/uploads/' . $data['file'];

  		    if(file_exists($file))
  		    {
              # delete foto from database
              $media = Media::where('name', $data['file'])->first();
              $media->delete();

              # unlink from folder
  				    unlink($file);
  		    }
  		}
    }

    public function get($id)
    {
      $media = Media::find($id);

      return $media;
    }

    public function datatable(Request $request)
    {
      # retrive request
      $searchValue = $request->input('search.value');
      $start       = $request->input('start');
      $length      = $request->input('length');
      $draw        = $request->input('draw');

      $limit       = $request->input('limit');

      # total data
      $totalData     = Media::all()->count();

      # validate search request
      if ( $searchValue )
      {
        # get all user with filter
        $user = Media::where('old_title', 'like', '%'.$searchValue.'%')
        ->orderBy('created_at', 'desc')
        ->offset($start)
        ->limit($length)
        ->get();
      }
      else
      {
        # get all user without filter
        $user = Media::offset($start)
        ->orderBy('created_at', 'desc')
        ->limit($length)
        ->get();
      }

      # total filtered
      $totalFiltered = $user->count();

      $i = 1 + $start;
      $resource = [];
      foreach ($user as $key => $value) {
        $check = '<input value="'.$value->id.'" class="form-control deleteRow rowChecked" type="checkbox">';
        if ($limit=="1") {
          $check = '<input value="'.$value->id.'" name="radio" class="form-control deleteRow rowChecked" type="radio">';
        }

        $image = "<img style='max-width: 20%;' class='text-center img-responsive' src='".asset($value->file)."' />";
        $resource[] = array_values([
          'image'       => '
            <span class="icon-with-child m-r">
              '.$image.'
            </span>
          ',
          'name'        => $value->old_name,
          'checkbox'    => $check,
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
