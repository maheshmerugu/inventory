<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use App\Http\Requests\StoreItemGroupRequest;
use App\Http\Requests\UpdateItemGroupRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;



class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-item-group|edit-item-group|delete-item-group', ['only' => ['index','show']]);
        $this->middleware('permission:create-item-group', ['only' => ['create','store']]);
        $this->middleware('permission:edit-item-group', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-item-group', ['only' => ['destroy']]);
    }


   public function index(): View
    {
        return view('admin.itemgroup.index', [
            'items' => ItemGroup::latest()->paginate(10)
        ]);
    }



    public function create(): View
    {


        return view('admin.itemgroup.create');
    }


    public function store(StoreItemGroupRequest $request)
    {
        ItemGroup::create($request->all());
        return response()->json(['success' => 'Item Group Master Added Successfully!']);

    }

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
  

    /**
     * Display the specified resource.
     */
    public function show(ItemGroup $itemGroup):View
    {
        return view('admin.itemgroup.show', [
            'items' => $itemGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id):View

    {
        $item = ItemGroup::find($id);
        return view('admin.itemgroup.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemGroupRequest $request, ItemGroup $itemGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemGroup $itemGroup)
    {
        //
    }
}
