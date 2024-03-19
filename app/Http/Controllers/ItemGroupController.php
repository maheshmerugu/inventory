<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ItemGroup;


class ItemGroupController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');

        // Initialize the query builder
        $query = ItemGroup::query();
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


        return view('admin.itemgroup.index', compact('items', 'searchQuery', 'statusQuery'));
    }



    public function edit($id)

    {
        $item = ItemGroup::find($id);
        return view('admin.itemgroup.edit', compact('item'));
    }

    public function create()
    {
        return view('admin.itemgroup.create');
    }

    public function search(Request $request)
    {
        $items = ItemGroup::all();
        if ($request->keyword != '') {
            $items = ItemGroup::where('status', 'LIKE', '%' . $request->keyword . '%')->get();
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
                'group_code' => 'required|max:255',
                'group_name' => 'required|string|max:255',
                'status' => 'required'

            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $item = ItemGroup::find($request->id);

        // dd($item);
        $item->group_name = $request->group_name;
        $item->group_short_name = $request->group_short_name;
        $item->status = $request->status;

        $item->save();
        return response()->json(['success' => 'Item Group Master Updated Successfully!']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'group_code' => 'required|unique:item_groups|max:255',
                'group_name' => 'required|string|max:255',
                'status' => 'required',
                'group_short_name' => 'required|string|max:255',


            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $group = new ItemGroup([
            'group_name' => $request->input('group_name'),
            'group_code' => $request->input('group_code'),
            'group_short_name' => $request->input('group_short_name'),

        ]);
        $group->save();
        return response()->json(['success' => 'Item Group Master Added Successfully!']);
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

            $item = ItemGroup::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Item Group Master Deleted Successfully!']);
        }
    }
}
