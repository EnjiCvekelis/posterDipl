<?php

namespace App\Dal\Entities\Admin;

use App\Dal\Entities\Locale;

class LocaleAdmin extends Locale
{
    public static function getGrid($query, $itemsPerPage)
    {
        if ($query) {
            return self::where('language', 'like', "%$query%")

                ->orderBy('language')

                ->paginate($itemsPerPage);
        } else {
            return self::orderBy('language')

                ->paginate($itemsPerPage);
        }
    }
}