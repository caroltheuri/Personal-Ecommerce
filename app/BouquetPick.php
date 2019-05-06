<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BouquetPick extends Model
{
    protected $guarded = [];

    public function pick()
    {
        return $this->belongsTo(Picking::class);
    }
    public function bouquet()
    {
        return $this->belongsTo(Bouquet::class);
    }
}
