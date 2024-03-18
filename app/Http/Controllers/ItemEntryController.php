<?php

namespace App\Http\Controllers;

use App\Models\ItemEntry;
use App\Models\ItemGroup;
use App\Models\VendorMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ItemEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = ItemEntry::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('group_code', 'like', '%' . $searchQuery . '%');
        }
        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.itementry.index', compact('items', 'searchQuery', 'statusQuery'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $item_groups = ItemGroup::all();
        $vendors = VendorMaster::all();

        return view('admin.itementry.create', compact('item_groups', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'po_number' => 'required|unique:item_entries|max:255',
                'vendor_id' => 'max:10', 'min:10',
                'purchased_date' => 'required|date_format:Y-m-d',
                'item_group_id' => 'required',


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {


            try {

                foreach ($request->item as $key => $value) {

                    $value['po_number'] = $request->po_number;
                    $value['purchased_date'] = $request->purchased_date;
                    $value['vendor_id'] = $request->vendor_id;
                    $value['item_group_id'] = $request->item_group_id;
                    ItemEntry::create($value);
                }

                return response()->json(['success' => 'Inventory Request Added Successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to add Inventory Request: ' . $e->getMessage()], 500);
            }
        }
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

        $item=ItemEntry::find($id);
        $vendors=VendorMaster::all();
        $item_groups=ItemGroup::all();
        return view('admin.itementry.edit',compact('item','vendors','item_groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'po_number' => 'required',
                'vendor_id' => 'max:10', 'min:10',
                'purchased_date' => 'required|date_format:Y-m-d',
                'item_group_id' => 'required',
                'item_name'=>'required',
                'serial_number'=>'required',
                'amc_warrenty'=>'required'


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {


            try {

               $item= ItemEntry::find($id);
               $item->po_number=$request->po_number;
               $item->purchased_date=$request->purchased_date;
               $item->vendor_id=$request->vendor_id;
               $item->item_group_id=$request->item_group_id;

               $item->item_name=$request->item_name;
               $item->serial_number=$request->serial_number;
               $item->amc_warrenty=$request->amc_warrenty;
               $item->status=$request->status;
               $item->save();


                return response()->json(['success' => 'Item Entry Updated Successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to add Inventory Request: ' . $e->getMessage()], 500);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
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


            try {

               $item= ItemEntry::find($request->id);
               $item->delete();


                return response()->json(['success' => 'Item Entry Deleted Successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to delete Item Entry Request: ' . $e->getMessage()], 500);
            }
        }
    }
}
