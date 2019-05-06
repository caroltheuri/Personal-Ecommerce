<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowerType extends Model
{
    protected $guarded = [];

    public function plantings()
    {
        return $this->hasMany(Planting::class);
    }
}
