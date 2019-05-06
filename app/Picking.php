<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picking extends Model
{
    protected $guarded = [];

    public function plant()
    {
        return $this->belongsTo(Planting::class);
    }
    public function bouquetpicks()
    {
        return $this->hasMany(BouquetPick::class);
    }
}
