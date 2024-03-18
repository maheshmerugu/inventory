<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\VendorMaster;


class VendorMasterController extends Controller
{



    public function create(){
        return view('admin.vendor.create');
    }

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');

        // Initialize the query builder
        $query = VendorMaster::query();
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


        return view('admin.vendor.index', compact('items', 'searchQuery', 'statusQuery'));
    }



    public function edit($id)

    {
        $item = VendorMaster::find($id);
        return view('admin.vendor.edit', compact('item'));
    }

    public function save()
    {
        return view('admin.itemgroup.save');
    }

    public function search(Request $request)
    {
        $items = VendorMaster::all();
        if ($request->keyword != '') {
            $items = VendorMaster::where('status', 'LIKE', '%' . $request->keyword . '%')->get();
        }
        return response()->json([
            'items' => $items
        ]);
    }

    public function update(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'vendor_code' => 'required|max:255',
                'vendor_name' => 'required|string|max:255',
                'status' => 'required',


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $item = VendorMaster::find($request->id);

        $item->vendor_name = $request->vendor_name;
        $item->vendor_email = $request->vendor_email;
        $item->vendor_phone=$request->vendor_phone;
        $item->vendor_city=$request->vendor_city;
        $item->vendor_address=$request->vendor_address;
        $item->status = $request->status;

        $item->save();
        return response()->json(['success' => 'Vendor Master Updated Successfully!']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vendor_code' => 'required|unique:vendor_masters|max:255',
                'vendor_name' => 'required|string|max:255',
                'vendor_email'=>'required',
                'status' => 'required',


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $group = new VendorMaster([
            'vendor_code' => $request->input('vendor_code'),
            'vendor_name' => $request->input('vendor_name'),
            'vendor_email' => $request->input('vendor_email'),
            'vendor_phone' => $request->input('vendor_phone'),
            'vendor_city' => $request->input('vendor_city'),
            'vendor_address' => $request->input('vendor_address'),
            'status' => $request->input('status'),



        ]);
        $group->save();
        return response()->json(['success' => 'Vendor Master Added Successfully!']);
    }

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

            $item = VendorMaster::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Vendor  Master Deleted Successfully!']);
        }
    }
}
