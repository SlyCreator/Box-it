<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = ['name','description','amount'];
}
