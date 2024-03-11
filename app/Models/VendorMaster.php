<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id', 'vendor_name','vendor_email','vendor_phone','vendor_city','vendor_address','status'
    ];

}
