<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\CourtsMaster;
use App\Models\CourtsComplex;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



class CourtComplexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index3(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');

        // Initialize the query builder
        $query = CourtsComplex::query();

        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            // Fetch district_id from districts table where name matches the search query
            $districtId = District::where('name', 'LIKE', '%' . $searchQuery . '%')->pluck('id')->first();
            if ($districtId !== null) {
                // Add condition to check if district_id matches in courts_complexes table
                $query->where('district_id', $districtId);
            } else {
                // If no district found, return empty result
                $query->where('district_id', null); // Ensures no results returned
            }
        }

        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'LIKE', '%' . $statusQuery . '%');
        }

        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);

        // Pass searchQuery and statusQuery to the view
        return view('admin.courtscomplex.index', compact('items', 'searchQuery', 'statusQuery'));
    }

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = CourtsComplex::query();
        if ($searchQuery !== null && $searchQuery !== '') {
            $districtId = District::where('name', 'LIKE', '%' . $searchQuery . '%')->pluck('id')->first();
            if ($districtId !== null) {
                $query->where('district_id', $districtId);
            } else {
                $query->where('district_id', null);
            }
        }
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'LIKE', '%' . $statusQuery . '%');
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.courtscomplex.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    public function index1(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = CourtsComplex::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('complex_name', 'LIKE', '%' . $searchQuery . '%');
        }
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', $statusQuery);
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.courtscomplex.index', compact('items', 'searchQuery', 'statusQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_districts = District::all();
        //dd($all_districts);
        return view('admin.courtscomplex.create', compact('all_districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'district_id' => 'required',
                'court.*.complex_name' => 'required|unique:courts_complexes,complex_name,NULL,id,district_id,' . $request->district_id,
            ],
            [
                'district_id.required' => 'District ID is required.',
                'court.*.complex_name.required' => 'Complex name is required.',
                'court.*.complex_name.unique' => 'Complex name must be unique within the district.',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        foreach ($request->court as $key => $value) {
            // Add the district_id to the $value array
            $value['district_id'] = $request->district_id;
            // Create a new CourtsComplex record with the updated $value array
            CourtsComplex::create($value);
        }
        //dd($request);
        return response()->json(['success' => 'CourtComplex Added Successfully!']);
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
        $item = CourtsComplex::find($id); // Using findOrFail to automatically handle 404 if item is not found
        $all_districts = District::all();

        return view('admin.courtscomplex.edit', compact('item', 'all_districts'));
    }
    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'district_id' => 'required',
            'status' => 'required|in:0,1',
        ], [
            'name.required' => 'Complex Name is required.',
            'district_id.required' => 'District ID is required.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status value.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $item = CourtsComplex::find($id);
        if (!$item) {
            return response()->json(['errors' => 'Court Complex not found.']);
        }

        $item->complex_name = $request->name;
        $item->status = $request->status;
        $item->district_id = $request->district_id;

        $item->save();

        return response()->json(['success' => 'Court Complex Updated Successfully!']);
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

            $item = CourtsComplex::find($request->id);
            $item->delete();
            return response()->json(['success' => 'CourtComplex Deleted Successfully!']);
        }
    }
}
