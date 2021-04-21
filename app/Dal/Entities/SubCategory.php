<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubCategory extends EntityBase
{
    protected $table = 'sub_categories';

    /**
     * @var array
     */

    protected $fillable = ['name', 'icon', 'sort_order'];

    public function category() :BelongsToMany
    {
        return $this->belongsToMany(Goods::class, 'categories_subcategories', 'subcategory_id', 'category_id');
    }

    public function track() :BelongsToMany
    {
        return $this->belongsToMany(Track::class, 'subcategories_tracks', 'subcategory_id', 'track_id')->orderBy('sort_order');
    }
}
