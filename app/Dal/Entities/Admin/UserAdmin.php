<?php

namespace App\Dal\Entities\Admin;

use App\Dal\Entities\User;

class UserAdmin extends User
{
    public static function getGrid($query, $itemsPerPage)
    {
        if ($query) {
            return self::where('name', 'like', "%$query%")

                ->orderBy('created_at')

                ->paginate($itemsPerPage);
        } else {
            return self::orderBy('created_at')

                ->paginate($itemsPerPage);
        }
    }
}