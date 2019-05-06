<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boxing extends Model
{
    protected $guarded = [];

    public function bouquets()
    {
        return $this->hasMany(Bouquet::class);
    }
    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
