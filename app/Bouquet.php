<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    protected $guarded = [];

    public function bouquetpicks()
    {
        return $this->hasMany(BouquetPick::class);
    }
    public function box()
    {
        return $this->belongsTo(Boxing::class);
    }
}
