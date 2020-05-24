<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['order_id','ref_code','amount','is_paid'];
    //
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id','DESC');
    }
}
