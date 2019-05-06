<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
    public function orderstatus(){
        return $this->hasMany(OrderStatus::class);
    }
}
