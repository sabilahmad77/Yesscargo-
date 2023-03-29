<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentsController extends Controller
{
    public function allShipmentsList(){
        $data['InvoicesList']  = Invoice::where('branch_admin_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('cargo_master.shipments.index')->with($data);
    }

    public function shipmentStatusUpdate(Request $request){
      //  return $request;
       $invoice =  Invoice::where('invoice_no', $request->invoiceId)->first();
       $invoice->shipment_status = $request->shipmentStatus;
       $invoice->save();
       return 'success';
    }

    public function searchShipment(Request $request){
   
        //Invoice::where()->first();
        $q = Invoice::query();

        if ($request->filled('invoice_number'))
        {
            $q->where('invoice_no',$request->invoice_number);
        }

        if ($request->filled('consignee_phone'))
        {
            $q->orwhere('cosignee_phone1',$request->consignee_phone);
        }
        $data['shipment'] = $q->first();
        $data['invoice_number'] = $request->filled('invoice_number');
        $data['consignee_phone'] = $request->filled('consignee_phone');
        return view('cargo_master.track_shipment.index')->with($data);


    }
}
