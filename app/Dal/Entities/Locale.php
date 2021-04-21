<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Locale extends EntityBase
{
    protected $table = 'languages';

    /**
     * @var array
     */

    protected $fillable = ['language'];

    public function category() :BelongsToMany
    {
        return $this->belongsToMany(Goods::class, 'categories_languages', 'locale_id', 'category_id');
    }
}
