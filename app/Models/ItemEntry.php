<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEntry extends Model
{
    use HasFactory;

    protected $guarded=[];



    public function getVendorName()
    {
        return $this->belongsTo(VendorMaster::class, 'vendor_id');
    }


    public function getItemGroupName()
    {
        return $this->belongsTo(ItemGroup::class, 'item_group_id');
    }


}
