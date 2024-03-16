<?php

namespace App\Http\Controllers;

use App\Models\InventoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use Barryvdh\DomPDF\Facade\Pdf;




class InventoryRequestController extends Controller
{
    public function create()
    {
        return view('admin.inventoryRequest.create');
    }

    public function index(Request $request)
    {

        $searchQuery = $request->input('search');
        $statusQuery = $request->input('status');

        // Initialize the query builder
        $query = InventoryRequest::query();
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


        return view('admin.inventoryRequest.index', compact('items', 'searchQuery', 'statusQuery'));
        return view('admin.inventoryRequest.index', compact('items'));
    }

    public function store(Request $request)
    {

        $user_id = Auth::id();



        $validator = Validator::make(
            $request->all(),
            [
                'subject' => 'required|alpha|max:255',
                'message' => 'required|string|max:255',

            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            try {
                InventoryRequest::create([
                    'subject' => $request->subject,
                    'message' => $request->message,
                    'created_by'=>$user_id,
                ]);

                return response()->json(['success' => 'Inventory Request Added Successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to add Inventory Request: ' . $e->getMessage()], 500);
            }
        }
    }


    public function edit(string $id)
    {
        $item = InventoryRequest::find($id);
        return view('admin.inventoryRequest.edit', compact('item'));
    }


    public function update(Request $request)
    {

        $user_id = Auth::id();

        $validator = Validator::make(
            $request->all(),
            [
                'subject' => 'required|alpha|max:255',
                'message' => 'required|string|max:255',
            ],
            []
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            try {
                $inventory = InventoryRequest::find($request->id);

                // dd($item);
                $inventory->subject = $request->subject;
                $inventory->message = $request->message;
                $inventory->created_by=$user_id;
                // $item->status = $request->status;

                $inventory->save();
                return response()->json(['success' => 'Inventory Request Updated Successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to Update Inventory Request: ' . $e->getMessage()], 500);
            }
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

            $item = InventoryRequest::find($request->id);
            $item->delete();
            return response()->json(['success' => 'Inventory Request Deleted Successfully!']);
        }
    }


    public function download(Request $request)
    {

        // dd($request->all());

       $data= InventoryRequest::find($request->id);

    //    dd($data);
        // HTML content for the PDF (You can fetch this content from your database or dynamically generate it)
        // $data = 'Subject of the Letter';
        // $message = 'This is the content of the letter. You can add your message here.';
        
        $html = '<html>
                    <body>
                        <h1>' . $data['subject']. '</h1>
                        <p>' . $data['message']. '</p>
                    </body>
                 </html>';
        
        // Generate PDF using DOMPDF
        $pdf = PDF::loadHTML($html);
        
        // Download the PDF file
        return $pdf->download('document.pdf');
    }

    public function  statusChange(Request $request){

       

        try {
            if(isset($request->id) && ($request->status == "approved")){

                $inventory=InventoryRequest::find($request->id);
                $inventory->status=1;
                $inventory->save();
                return response()->json(['success' => 'Inventory Request Status Updated Successfully!']);

    
            }else if(isset($request->id) && ($request->status == 'rejected')){


                $inventory=InventoryRequest::find($request->id);
                $inventory->status=0;
                $inventory->save();
                return response()->json(['success' => 'Inventory Request Status Updated Successfully!']);

            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to add Inventory Request: ' . $e->getMessage()], 500);
        }
        
    }
}
