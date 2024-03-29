<?php

namespace App\Models;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name','email','sent_from','tracking_code',
                            'weight_in_kg', 'height_in_m','length_in_m',
                            'service_type_id','staff_id'];

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
