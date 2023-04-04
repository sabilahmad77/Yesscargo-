<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Invoice; 
use App\Models\ReturnBox;  
use App\Models\ShipmentBoxes;
use Illuminate\Http\Request; 
use App\Models\InvoiceItemDetail;
use Illuminate\Support\Facades\Auth;

class ReturnBoxController extends Controller
{
    public function ReturnBoxIndexPage(){

        if(Auth::user()->hasRole('Admin')){
            $data['returnBoxes'] = ReturnBox::with('invoice','Shipmentbox')->get();
        }elseif(Auth::user()->hasRole('Branch-Admin')){
            $user = User::with('branch')->find(Auth::user()->id);
            $data['returnBoxes'] = ReturnBox::with('invoice','Shipmentbox')->where('branch_id', $user->branch->id)->get();
        }

        return view('cargo_master.return_box.index')->with($data);
        
    }

    public function ReturnBoxCreate(){
        //return $user = User::with('branch')->find(Auth::user()->id);
       // $data['invoice'] = Invoice::latest()->first();
        return view('cargo_master.return_box.create');
    }

    public function addFromInvoiceToReturnBox(Request $request){
        //return $request->searchInvoice; branch_id
        $user = User::with('branch')->find(Auth::user()->id);
        $data['invoice'] = Invoice::with('boxes.boxes_items','customer')->where(['invoice_no' => $request->searchInvoice, 'branch_id' => $user->branch->id])->first();
        return view('cargo_master.partials.invoice_items_description')->with($data);
    }

    public function addItemToReturnBox(Request $request){
        
        //return $request->itemId;
        $invoiceItem = ShipmentBoxes::find($request->itemId);
        $invoiceItem->return_box = 1;
        $invoiceItem->save();

        // ReturnBox::create([
        //     'branch_id' => $request->branchId,
        //     'invoices_id' => $request->invoiceId,
        //     ' invoice_item_details_id' => $request->itemId
        // ]);

        $data = array( 
            'branch_id' => $request->branchId,
            'invoices_id' => $request->invoiceId,
            'invoice_item_details_id' => $request->itemId,
        );
        
        $Inventory = ReturnBox::create($data);

        $user = User::with('branch')->find(Auth::user()->id);
        $data['invoice'] = Invoice::with('invoice_item_details','customer')->where(['invoice_no' => $request->invoiceId, 'branch_id' => $user->branch->id])->first();
        return view('cargo_master.partials.invoice_items_description')->with($data);
    }
}
