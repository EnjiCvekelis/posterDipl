<?php

namespace App\Http\Controllers\Admin;

use App\Dal\Entities\Feed;
use App\Exports\RemainsExport;
use App\Http\Controllers\BkControllerBase;

class RemainsController extends BkControllerBase
{
    public function excel()
    {
        return \Excel::download(new RemainsExport(), 'remains.xlsx');
    }
}
