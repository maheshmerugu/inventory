<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'pages';
    protected $fillable = [
        'page_section_id' ,
            'page_name',
        'page_url',
        'status,'
    ];

    // CourtsComplex model
    public function pagesection()
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

   
}
