<?php

namespace App\Models;

use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = ['order_id','state','country','address','zipCode'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
