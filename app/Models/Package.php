<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['order_id','arrival','arrival_at','departure','departure_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
