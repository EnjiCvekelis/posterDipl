<?php

namespace App\Dal\Entities\Admin;

use App\Dal\Entities\Writeoffs;


class WriteoffsAdmin extends Writeoffs
{
    public static function getGrid($query, $itemsPerPage)
    {
        if ($query) {
            return self::where('amount', 'like', "%$query%")

                ->orderBy('created_at')

                ->paginate($itemsPerPage);
        } else {
            return self::orderBy('created_at')

                ->paginate($itemsPerPage);
        }
    }
}