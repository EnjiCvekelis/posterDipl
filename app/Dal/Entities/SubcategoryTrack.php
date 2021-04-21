<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryTrack extends EntityBase
{
    protected $table = 'subcategories_tracks';

    /**
     * @var array
     */

    protected $fillable = ['track_id', 'subcategory_id'];

    public $timestamps = false;
}
