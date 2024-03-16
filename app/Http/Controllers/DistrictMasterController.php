<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\District;

class DistrictMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');

        // Initialize the query builder
        $query = District::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        }

        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }


        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);


        return view('admin.district.index', compact('items', 'searchQuery', 'statusQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.district.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:districts|max:255|regex:/^[a-zA-Z\s]+$/',
                'status' => 'required',
            ],
            ['name.required'=>'District Name Field is required.']
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        District::create([
            'name'=>$request->name,
            'status'=>$request->status,
        ]);

        return response()->json(['success' => 'District  Added Successfully!']);
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
        $item = District::find($id);
        return view('admin.district.edit', compact('item'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|alpha',
                'status' => 'required|string|max:255',

            ],
            ['name.required'=>'District Name Field is Required!']
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $item = District::find($request->id);

        $item->name = $request->name;
        $item->status = $request->status;


        $item->save();
        return response()->json(['success' => 'District Updated Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                ],
                []
            );
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
    
                $item = District::find($request->id);
                $item->delete();
                return response()->json(['success' => 'District Deleted Successfully!']);
            }
        }
    
}
