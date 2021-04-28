<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Goods extends EntityBase
{
    protected $table = 'goods';

    /**
     * @var array
     */

    protected $fillable = ['name'];

    public function deliveries() {
        return $this->hasMany(Deliveries::class);
    }
}
