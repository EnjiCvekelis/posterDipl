<?php

namespace App\Http\Controllers\Client\Base;

use App\Http\Controllers\Controller;

abstract class ClientControllerBase extends Controller
{
  protected function view($view = null, $data = [], $mergeData = [])
  {

    return view($view, $data, $mergeData);
  }
}
