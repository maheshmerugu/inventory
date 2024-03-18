<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ItemMaster;

class ItemMasterController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = ItemMaster::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('item_code', 'like', '%' . $searchQuery . '%');
        }
        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.itemmaster.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    public function edit($id)
    {
        $item = ItemMaster::find($id);
        return view('admin.itemmaster.edit', compact('item'));
    }
    public function save()
    {
        return view('admin.itemmaster.save');
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                //'group_name' => 'required',
                'item_code' => 'required|max:255',
                //'item_name' => 'nullable|string|max:255',
                //'pn' => 'required',
                //'critical' => 'required',
                //'status' => 'required',
            ],
            [
                //'group_name.required' => 'Group is required',
                //'item_code.required' => 'Item Code is required',
                //'pn.required' => 'PN/ (Y/N) selection is required',
                // 'critical.required' => 'Critical selection is required',
                // 'active.required' => 'Active selection is required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $itemMaster = ItemMaster::find($request->id);
        if (!$itemMaster) {
            return response()->json(['errors' => 'Item Master not found']);
        }
        $itemMaster->group_name = $request->input('group_name');
        $itemMaster->item_code = $request->input('item_code');
        $itemMaster->item_name = $request->input('item_name');
        $itemMaster->pn = $request->input('pn');
        $itemMaster->critical = $request->input('critical');
        $itemMaster->status = $request->input('status');
        $itemMaster->save();
        return response()->json(['success' => 'Item Master Updated Successfully!']);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                //'group_name' => 'required',
                'item_code' => 'required|unique:item_masters|max:255',
                //'item_name' => 'required|string|max:255',
                //'pn' => 'required',
                //'critical' => 'required',
                //'status' => 'required',
            ],
            [
               // 'group_name.required' => 'Group is required',
                'item_code.required' => 'Item Code is required',
               // 'item_code.unique' => 'Item Code must be unique',
                //'pn.required' => 'PN/ (Y/N) selection is required',
                //'critical.required' => 'Critical selection is required',
               // 'status.required' => 'Status selection is required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $itemMaster = new ItemMaster([
            'group_name' => $request->input('group_name'),
            'item_code' => $request->input('item_code'),
            'item_name' => $request->input('item_name'),
            'pn' => $request->input('pn'),
            'critical' => $request->input('critical'),
            'status' => $request->input('status'),
        ]);
        $itemMaster->save();
        return response()->json(['success' => 'Item Master Added Successfully!']);
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

            $item = ItemMaster::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Item Master Deleted Successfully!']);
        }
    }
}
