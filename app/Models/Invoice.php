<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [];
    //
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
