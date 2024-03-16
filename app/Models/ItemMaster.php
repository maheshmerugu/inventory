<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    use HasFactory;
    protected $table="item_masters";
    protected $fillable = [
        'group_name',
        'item_code',
        'item_name',
        'pn',
        'critical',
        'status',
    ];
}
