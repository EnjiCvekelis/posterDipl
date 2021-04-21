<?php

namespace App\Dal\Entities\Admin;

use App\Dal\Entities\Track;

class TrackAdmin extends Track
{
    public static function getGrid($query, $itemsPerPage)
    {
        if ($query) {
            return self::where('name', 'like', "%$query%")

                ->orderBy('sort_order')

                ->paginate($itemsPerPage);
        } else {
            return self::orderBy('sort_order')

                ->paginate($itemsPerPage);
        }
    }
}