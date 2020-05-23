<?php

namespace App\Models;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name','email','sent_from',
                'weight_in_kg', 'height_in_m','length_in_m',
                'service_type_id','user_id'];

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

}
