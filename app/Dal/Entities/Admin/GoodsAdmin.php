<?php

namespace App\Dal\Entities\Admin;

use App\Dal\Entities\Goods;

class GoodsAdmin extends Goods
{
    public static function getGrid($query, $itemsPerPage)
    {
        if ($query) {
            return self::where('name', 'like', "%$query%")

                ->orderBy('name')

                ->paginate($itemsPerPage);
        } else {
            return self::orderBy('name')

                ->paginate($itemsPerPage);
        }
    }
}