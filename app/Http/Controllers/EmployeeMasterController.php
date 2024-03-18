<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\EmployeeMaster;

class EmployeeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        $query = EmployeeMaster::query();
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('group_code', 'like', '%' . $searchQuery . '%');
        }
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }
        $items = $query->paginate(10);
        return view('admin.employee.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employee.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee_code' => 'required|unique:employee_masters|max:255',
                'employee_mobile'=>'max:10','min:10',
                'status'=>'required'
            ],
            []
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        EmployeeMaster::create([
            'employee_code' => $request->employee_code,
            'employee_name'=>$request->employee_name,
            'employee_designation'=>$request->employee_designation,
            'employee_mobile'=>$request->employee_mobile,
            'employee_email'=>$request->employee_email,
            'district'=>$request->district,
            'status'=>$request->status,
            'address'=>$request->address,
            'location'=>$request->location
        ]);
        return response()->json(['success' => 'Employee Master Added Successfully!']);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
            $item = EmployeeMaster::find($id);
            return view('admin.employee.edit', compact('item'));
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'employee_code' => 'required|max:255',
                'status' => 'required'

            ],
            []
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $item = EmployeeMaster::find($request->id);
        // dd($item);
        $item->employee_code = $request->employee_code;
        $item->employee_name = $request->employee_name;
        $item->employee_designation=$request->employee_designation;
        $item->employee_mobile=$request->employee_mobile;
        $item->employee_email=$request->employee_email;
        $item->district=$request->district;
        $item->location=$request->location;
        $item->address=$request->address;
        $item->status = $request->status;
        $item->save();
        return response()->json(['success' => 'Employee Master Updated Successfully!']);
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

            $item = EmployeeMaster::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Employee Master Deleted Successfully!']);
        }
    }
}
