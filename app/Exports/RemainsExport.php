<?php

namespace App\Exports;

use App\Dal\Entities\Remains;
//use Maatwebsite\Excel\Concerns\FromCollection;

class RemainsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        return Remains::all();
    }
}
