<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMaster extends Model
{
    use HasFactory;
    protected $fillable=['employee_code','employee_name','employee_designation','employee_mobile','employee_email','district','location','status','address','district'];

}
