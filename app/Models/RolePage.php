<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePage extends Model
{
    use HasFactory;

    protected $table = 'role_pages'; // Corrected table name

    protected $fillable = [
        'role_id',
        'page_id',
    ];

    // Define the relationship with the Role model
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    // Define the relationship with the Page model
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    // Define the many-to-many relationship with the Page model
    public function pages()
    {
        return $this->belongsToMany(Page::class, 'role_pages', 'role_id', 'page_id');
    }
}
