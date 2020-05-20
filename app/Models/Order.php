<?php

namespace App\Models;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

}
