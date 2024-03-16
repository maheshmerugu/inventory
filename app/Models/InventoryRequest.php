<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryRequest extends Model
{
    use HasFactory;

    protected $fillable=['subject','message','created_by'];

    protected $table='inventory_requests';


    public function requestedName()
    {
        return $this->belongsTo(User::class, 'id');
    }

}
