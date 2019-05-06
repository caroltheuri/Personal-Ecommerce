<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $guarded = [];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function feature(){
        return $this->belongsTo(Feature::class);
    }
}
