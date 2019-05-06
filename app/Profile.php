<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
