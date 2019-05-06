<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    public function boxes()
    {
        return $this->hasMany(Boxing::class);
    }
}
