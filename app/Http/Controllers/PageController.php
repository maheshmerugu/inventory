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
        $pageSectionName = $request->input('page_section_name');

        // Initialize the query builder
        $query = Page::query();

        // If page_section_name query is provided, find the corresponding page_section_id
        if ($pageSectionName) {
            $pageSectionId = PageSection::where('page_section_name', $pageSectionName)->value('id');
            if ($pageSectionId) {
                $query->where('page_section_id', $pageSectionId);
            } else {
                // If page_section_id is not found, return empty result
                $items = [];
                return view('admin.pages.index', compact('items', 'searchQuery', 'statusQuery'));
            }
        }

        // If search query is provided or not empty, add search condition to the query
        if ($searchQuery !== null && $searchQuery !== '') {
            $query->where('page_name', 'like', '%' . $searchQuery . '%');
        }

        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', $statusQuery);
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
        $all_sections = PageSection::all();
        return view('admin.pages.edit', compact('item', 'all_sections'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'page_name' => 'required|unique:pages,page_name,' . $request->id . ',id,page_section_id,' . $request->input('page_section_id'),
                'page_section_id' => 'required',
            ],
            [
                'page_name.required' => 'Page Name is required.',
                'page_name.unique' => 'Page Name must be unique within the same page section.',
                'page_section_id.required' => 'Page Section is required.',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $item = Page::find($request->id);
        if (!$item) {
            return response()->json(['error' => 'Page not found.']);
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
                'pages_section_id' => 'required',
                'pagesection.*.page_name' => 'required|unique:pages,page_name,NULL,id,page_section_id,' . $request->pages_section_id,
            ],
            [
                'pages_section_id.required' => 'Page Section is required.',
                'pagesection.*.page_name.required' => 'Page name is required.',
                'pagesection.*.page_name.unique' => 'Page name must be unique within the page section.',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        foreach ($request->pagesection as $key => $value) {
            // Check if the page name already exists for the given page section
            $existingPage = Page::where('page_section_id', $request->pages_section_id)
                ->where('page_name', $value['page_name'])
                ->first();
            if ($existingPage) {
                return response()->json(['errors' => ['page_name' => 'Page name already exists for this PageSection.']], 422);
            }
            // Add the page_section_id to the $value array
            $value['page_section_id'] = $request->pages_section_id;
            // Create a new Page record with the updated $value array
            Page::create($value);
        }
        return response()->json(['success' => 'Page(s) added successfully!']);
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
