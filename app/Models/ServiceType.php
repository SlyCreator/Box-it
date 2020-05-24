<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = ['name','description','amount_per_kg'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
