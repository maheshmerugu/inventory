<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_code', 'location_name','location_short_name','district','address','status'
    ];
}
