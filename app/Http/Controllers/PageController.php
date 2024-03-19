<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageSection;


class PageController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = Page::query();
        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('page_section_name', 'like', '%' . $searchQuery . '%');
        }
        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }
        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);
        return view('admin.pages.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    public function create()
    {
        $all_sections = PageSection::all();
        // dd($all_sections);
        return view('admin.pages.create', compact('all_sections'));
    }
    public function edit($id)
    {
        $item = Page::find($id);
        return view('admin.pages.edit', compact('item'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'page_name' => 'required|unique:pages|max:255',
            ],
            []
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $item = Page::find($request->id);
        if (!$item) {
            return response()->json(['errors' => 'Page not found']);
        }
        $item->page_name = $request->input('page_name');
        $item->page_url = $request->input('page_url');
        $item->status = $request->input('status');
        $item->save();
        return response()->json(['success' => 'Page Updated Successfully!']);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pagesection.*.page_name' => 'required|unique:page_sections,page_name,NULL,id,page_section_id,' . $request->page_section_id,
                'page_section_id' => 'required',
            ],
            [
                'page_section_id.required' => 'PageSection is required.',
                'pagesection.*.page_name.required' => 'Page name is required.',
                'pagesection.*.page_name.unique' => 'Page name must be unique within the page section.',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        foreach ($request->pagesection as $key => $value) {
            // Add the district_id to the $value array
            $value['page_section_id'] = $request->page_section_id;
            // Create a new CourtsMaster record with the updated $value array
            PageSection::create($value);
        }
        return response()->json(['success' => 'Page Added Successfully!']);
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
            $item = Page::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Page Deleted Successfully!']);
        }
    }
}
