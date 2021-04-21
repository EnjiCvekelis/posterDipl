<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubcategory extends EntityBase
{
    protected $table = 'categories_subcategories';

    /**
     * @var array
     */

    protected $fillable = ['category_id', 'subcategory_id'];

    public $timestamps = false;
}
