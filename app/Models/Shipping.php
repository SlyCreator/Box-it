<?php

namespace App\Models;

use App\Model\Order;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
