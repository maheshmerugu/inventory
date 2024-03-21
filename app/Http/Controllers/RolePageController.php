<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\RolePage;
use App\Models\Page;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePageController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder with eager loading of related models
        $query = RolePage::with(['role', 'page']);
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->whereHas('role', function ($q) use ($searchQuery) {
                $q->where('role_name', 'like', '%' . $searchQuery . '%');
            });
        }
        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.rolepages.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    public function create()
    {
        $all_roles = Role::all();
        $all_pages = Page::all();
        return view('admin.rolepages.create', compact('all_roles', 'all_pages'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role_id' => 'required',
                'pages' => 'required|array',
                'pages.*' => 'required|exists:pages,id',
            ],
            [
                'role_id.required' => 'Role ID is required.',
                'pages.required' => 'Pages are required.',
                'pages.*.required' => 'Page ID is required.',
                'pages.*.exists' => 'Invalid page ID.',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $role_id = $request->input('role_id');
        $pages = $request->input('pages');
        foreach ($pages as $page_id) {
            RolePage::create([
                'role_id' => $role_id,
                'page_id' => $page_id,
            ]);
        }
        return response()->json(['success' => 'Pages added successfully!']);
    }
    public function edit($id)
    {
        // Fetch all pages
        $all_pages = Page::all();

        // Fetch selected pages for the given role ID from your role_pages table
        $item = RolePage::with('page')->find($id);
        $selected_pages = RolePage::where('role_id', $item->role_id)->pluck('page_id')->toArray();

        $all_roles = Role::all();

        return view('admin.rolepages.edit', [
            'all_pages' => $all_pages,
            'selected_pages' => $selected_pages,
            'all_roles' => $all_roles,
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role_id' => 'required|exists:roles,id',
                'pages' => 'required|array',
            ],
            [
                'role_id.required' => 'Role ID is required.',
                'role_id.exists' => 'Invalid Role ID.',
                'pages.required' => 'Pages are required.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Retrieve the RolePage instance
        $item = RolePage::find($id);

        if (!$item) {
            return response()->json(['error' => 'Role Page not found.'], 404);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Update role_id in the role_pages table
            $item->role_id = $request->role_id;
            $item->save();

            // Delete previous records associated with this role
            RolePage::where('role_id', $request->role_id)->delete();

            // Create new records for the selected pages
            foreach ($request->pages as $pageId) {
                RolePage::create([
                    'role_id' => $request->role_id,
                    'page_id' => $pageId,
                ]);
            }
            // Commit the transaction
            DB::commit();
            // Redirect to rolepage.list route
            return redirect()->route('rolepage.list')->with('success', 'Role Page Updated Successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            // Handle any database errors
            return redirect()->route('rolepage.list')->with('error', 'An error occurred while updating the role page.');
        }
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
            $item = RolePage::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Role Page Deleted Successfully!']);
        }
    }
}
