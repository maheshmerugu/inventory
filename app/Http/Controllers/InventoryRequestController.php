<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryRequestController extends Controller
{
    public function create(){
        return view('admin.inventoryRequest.create');
    }
}
