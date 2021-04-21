<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Track extends EntityBase
{
    protected $table = 'tracks';

    /**
     * @var array
     */

    protected $fillable = ['name', 'description', 'length', 'track', 'cover', 'sort_order'];


    public function subcategory() :BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'subcategories_tracks', 'track_id', 'subcategory_id');
    }
}
