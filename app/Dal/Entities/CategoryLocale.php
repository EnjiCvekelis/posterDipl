<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLocale extends EntityBase
{
    protected $table = 'categories_languages';

    /**
     * @var array
     */

    protected $fillable = ['locale_id', 'category_id'];

    public $timestamps = false;
}
