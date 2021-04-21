<?php

namespace App\Http\Controllers\Admin;

use App\Dal\Entities\Feed;
use App\Http\Controllers\BkControllerBase;

class HomeController extends BkControllerBase
{
    public function index()
    {
        $breadcrumbs = array(
            array('name' => ' Home', 'href' => '/admin/home', 'current' => ''),
        );


        return view('admin.home.index', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function translations()
    {
        return view('vendor.translation.layout');
    }
}
