<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\PageSection;

class PageSectionController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');
        // Initialize the query builder
        $query = PageSection::query();
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
        return view('admin.pagesection.index', compact('items', 'searchQuery', 'statusQuery'));
    }
    public function edit($id)
    {
        $item = PageSection::find($id);
        return view('admin.pagesection.edit', compact('item'));
    }
    public function save()
    {
        return view('admin.pagesection.create');
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                //'page_section_name' => 'required|page_sections',
            ],
            []
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $item = PageSection::find($request->id);
        if (!$item) {
            return response()->json(['errors' => 'PageSection not found']);
        }
        $item->page_section_name = $request->input('page_section_name');
        $item->status = $request->input('status');
        $item->save();
        return response()->json(['success' => 'PageSection Updated Successfully!']);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'page_section_name' => 'required|unique:page_sections|max:255',
            ],
            []
        );
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $item = new PageSection([
            'page_section_name' => $request->input('page_section_name'),
            'status' => $request->input('status'),

        ]);
        $item->save();
        return response()->json(['success' => 'PageSection Added Successfully!']);
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
            $item = PageSection::find($request->id);
            $item->delete();
            return response()->json(['success' => 'PageSection Deleted Successfully!']);
        }
    }
}
