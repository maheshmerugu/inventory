<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;
    protected $table='page_sections';
    protected $fillable = [
        'page_section_name',
        'status,'
    ];
}
