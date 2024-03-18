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
            $query->where('subject', 'like', '%' . $searchQuery . '%');
        }

        // If status query is provided or not empty, add status condition to the query
        if ($statusQuery !== null && $statusQuery !== '') {
            $query->where('status', 'like', '%' . $statusQuery . '%');
        }


        // Retrieve paginated items based on the constructed query
        $items = $query->paginate(10);


        return view('admin.inventoryRequest.index', compact('items', 'searchQuery', 'statusQuery'));
    }

    public function store(Request $request)
    {

        $user_id = Auth::id();
        $validator = Validator::make(
            $request->all(),
            [
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:4000',

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

       $user_name = auth()->user()->name;


       $letter = [
        'to' => 'To',
        'whom' => 'The Registrar (Administration)',
        'location'=>'High Court of the State of Telangana',
        'dear' => 'Dear Sir/Madam,',
        'subject' => $data['subject'],
        'message' => $data['message'],
        'conclusion' => 'Thank you for considering my request.',
    ];
    
  
    
    $currentDate = date('d-m-Y');

   
    
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 20px;
    }
    
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border-radius: 5px;
    }
    
    .content {
        margin-bottom: 20px;
    }
    
    .subject {
        font-size: 15px;
        margin-bottom: 10px;
    }
    
    .conclusion {
        font-style: italic;
        text-align:center;
    }
    
    /* Style the "Sub:" text */
    .subject p {
        margin: 0;
        font-weight: bold;
    }
    
    .to-date p {
        margin: 0; /* Remove default margin */
        display: inline-block; /* Display elements inline-block */
    }
    
    .to-date .date {
        float: right; /* Float the date to the right */
    }
    
    .signature {
        text-align: right; /* Align signature text to the right */
    }
    </style>
    </head>
    <body>
    <div class="container">
        <div class="content">
            <div class="to-date">
                <p>' . $letter['to'] . '</p>
                <p class="date">' . $currentDate . '</p>
            </div>
            <p>' . $letter['whom'] . '</p>
            <p>' . $letter['location'] . '</p>
    
            <p>' . $letter['dear'] . '</p>
            <div class="subject">
                <p>Sub:' . $letter['subject'] . '</p>
            </div>
            <p>' . $letter['message'] . '</p>
            <p class="conclusion">' . $letter['conclusion'] . '</p>
        </div>
        <div class="signature">
            <p>Sincerely,</p>
            <p>' . $user_name . '</p>
        </div>
    </div>
    </body>
    </html>
    
    ';

    
    
    
    

// Generate PDF using DOMPDF
$pdf = PDF::loadHTML($html);


// Generate PDF using DOMPDF
$pdf = PDF::loadHTML($html);

    
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
