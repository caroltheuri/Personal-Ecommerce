<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $guarded = [];

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }
}
