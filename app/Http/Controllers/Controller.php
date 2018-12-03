<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Configuration;
use App\Media;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function getConfig($name='')
    {
      $configuration = Configuration::where('name', $name)->first();

      $value = '';
      if ($configuration) {
        $value = $configuration->value;
      }

      return $value;
    }

    public static function getLogoUrl()
    {
      $data = [];

      $image = self::getConfig('image');
      $media = Media::find($image);

      $data = '';
      if ($media) {
        $data = asset($media->file);
      }

      return $data;
    }
}
