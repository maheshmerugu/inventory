<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\CourtsMaster;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class CourtMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = CourtsMaster::query();
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
        return view('admin.courts.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       $all_districts= District::all();


        return view('admin.courts.create',compact('all_districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            // $request->all(),
            [
                'court.*.name' => 'required|unique:courts_masters,name,NULL,id,district_id,' . $request->district_id,
                'district_id' => 'required',
                // Add more validation rules as needed
            ],
            [
                'court.*.name.required' => 'Court name is required.',
                'court.*.name.unique' => 'Court name must be unique within the district.',
                'district_id.required' => 'District ID is required.',
                // Add more custom error messages as needed
            ]
        );
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

       

    
        foreach ($request->court as $key => $value) {

            // Add the district_id to the $value array
            $value['district_id'] = $request->district_id;
        
            // Create a new CourtsMaster record with the updated $value array
            CourtsMaster::create($value);
        }
    
        return response()->json(['success' => 'Court  Added Successfully!']);
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
        $item = CourtsMaster::find($id);
        $all_districts= District::all();

        return view('admin.courts.edit', compact('item','all_districts'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:courts_masters,name,NULL,id,district_id,' . $request->input('district_id'),
                'district_id' => 'required',
                // Add more validation rules as needed
            ],
            [
                'court.*.name.required' => 'Court name is required.',
                'name.unique' => 'Court name must be unique within the district.',
                'district_id.required' => 'District ID is required.',
                // Add more custom error messages as needed
            ]
        );
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $item = CourtsMaster::find($request->id);

        $item->name = $request->name;
        $item->status = $request->status;
       
        $item->save();
        return response()->json(['success' => 'Court Updated Successfully!']);
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

            $item = CourtsMaster::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Court  Master Deleted Successfully!']);
        }
    }
}
