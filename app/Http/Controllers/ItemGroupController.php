<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use App\Http\Requests\StoreItemGroupRequest;
use App\Http\Requests\UpdateItemGroupRequest;
use Illuminate\View\View;


class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-item-group|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }


   public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(3)
        ]);
    }


    public function create(): View
    {
        return view('products.create');
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::create($request->all());
        return redirect()->route('products.index')
                ->withSuccess('New product is added successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemGroup $itemGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemGroup $itemGroup)
    {
        //
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
