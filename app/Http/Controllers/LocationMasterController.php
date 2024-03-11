<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\LocationMaster;

class LocationMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');

        // Initialize the query builder
        $query = LocationMaster::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('vendor_id', 'like', '%' . $searchQuery . '%');
        }

        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }


        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);


        return view('admin.location.index', compact('items', 'searchQuery', 'statusQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'location_code' => 'required|unique:location_masters|max:255',
                'location_name' => 'required|string|max:255',
                'district'=>'required',


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        LocationMaster::create([
            'location_code' => $request->location_code,
            'location_name'=>$request->location_name,
            'location_short_name'=>$request->location_short_name,
            'district'=>$request->district,
            'address'=>$request->address,
            'status'=>$request->status,
        ]);

        return response()->json(['success' => 'Location Master Added Successfully!']);
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
        $item = LocationMaster::find($id);
        return view('admin.location.edit', compact('item'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'location_code' => 'required|max:255',
                'district' => 'required|string|max:255',


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $item = LocationMaster::find($request->id);

        $item->location_code = $request->location_code;
        $item->location_name = $request->location_name;
        $item->location_short_name=$request->location_short_name;
        $item->district=$request->district;
        $item->address = $request->address;
        $item->status = $request->status;


        $item->save();
        return response()->json(['success' => 'Location  Master Updated Successfully!']);
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

            $item = LocationMaster::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Location  Master Deleted Successfully!']);
        }
    
    }
}
