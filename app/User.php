<?php

namespace App;

use App\User_type;
use App\Feature;
use App\Product;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_types_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user_types(){
        return $this->hasMany(User_type::class);
    }
    public function feature(){
        return $this->hasMany(Feature::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function addCart(){
        return $this->belongsToMany(Order::class,'order_users')->withTimestamps();
    }
}
