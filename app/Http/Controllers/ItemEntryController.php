<?php

namespace App\Http\Controllers;

use App\Models\ItemEntry;
use App\Models\ItemGroup;
use App\Models\VendorMaster;
use Illuminate\Http\Request;

class ItemEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.itementry.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item_groups=ItemGroup::all();
        $vendors=VendorMaster::all();
        return view('admin.itementry.create',compact('item_groups','vendors'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
