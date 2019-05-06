<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planting extends Model
{
    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function flowertype()
    {
        return $this->belongsTo(FlowerType::class);
    }
    public function picks()
    {
        return $this->hasMany(Picking::class);
    }
}
