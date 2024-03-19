<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = Role::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('role_name', 'like', '%' . $searchQuery . '%');
        }
        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.roles.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    public function edit($id)
    {
        $item = Role::find($id);
        return view('admin.roles.edit', compact('item'));
    }
    public function save()
    {
        return view('admin.roles.create');
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role_name' => 'required|unique:roles|max:255',
            ],
            []
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $item = Role::find($request->id);
        if (!$item) {
            return response()->json(['errors' => 'Role not found']);
        }
        $item->role_name = $request->input('role_name');
        $item->role_short_name = $request->input('role_short_name');
        $item->status = $request->input('status');
        $item->save();
        return response()->json(['success' => 'Role Updated Successfully!']);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'court.*.role_name' => 'required|unique:roles|max:255',

            ],
            []
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        // $item = new Role([
        //     'role_name' => $request->input('role_name'),
        //     'role_short_name' => $request->input('role_short_name'),
        //     'status' => $request->input('status'),

        // ]);
        foreach ($request->court as $key => $value) {
            // Create a new Role instance
            $item = new Role([
                'role_name' => $value['role_name'],
                'role_short_name' => $value['role_short_name'],
                'status' => $value['status'],
            ]);
        
            // Save the Role instance
            $item->save();
        }
        
        return response()->json(['success' => 'Role Added Successfully!']);
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
            $item = Role::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Role Deleted Successfully!']);
        }
    }
}
