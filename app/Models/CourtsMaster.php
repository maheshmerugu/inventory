<?php

namespace App\Models;


use App\Models\District;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtsMaster extends Model
{
    use HasFactory;
    protected $fillable=['district_id','name','status'];
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

}
