<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtsComplex extends Model
{
    use HasFactory;

    protected $table = 'courts_complexs'; // Corrected table name
    protected $fillable = ['district_id', 'complex_name', 'status'];

    // CourtsComplex model
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
