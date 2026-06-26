<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stopdesk extends Model
{
    protected $fillable = ['wilaya_id', 'office_name', 'address', 'phone', 'maps_link'];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }
}
