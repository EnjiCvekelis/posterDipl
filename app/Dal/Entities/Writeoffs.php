<?php

namespace App\Dal\Entities;

use App\Dal\Entities\Base\EntityBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Writeoffs extends EntityBase
{
    protected $table = 'writeoffs';

    /**
     * @var array
     */

    protected $fillable = ['goods_id', 'amount', 'price', 'total'];

    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

}
