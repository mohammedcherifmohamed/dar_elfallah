<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    protected $fillable = ['name', 'home_delivery_price', 'stopdesk_price'];
}
