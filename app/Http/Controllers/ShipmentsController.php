<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ShipmentsController extends Controller
{
    public function allShipmentsList(){
        if(Auth::user()->hasRole('Admin')){
            $data['InvoicesList']  = Invoice::orderBy('id', 'DESC')->get();
            return view('cargo_master.shipments.index')->with($data);
        }else{
            $data['InvoicesList']  = Invoice::where('branch_admin_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return view('cargo_master.shipments.index')->with($data);
        }
        
    }

    public function shipmentStatusUpdate(Request $request){
      //  return $request;
       $invoice =  Invoice::where('invoice_no', $request->invoiceId)->first();
       $invoice->shipment_status = $request->shipmentStatus;
       $invoice->save();
       return 'success';
    }

    public function searchShipment(Request $request){
   
        $validate = Validator::make($request->all(), [
            'invoice_number' => 'required',

        ],[
          //  'name.required' => 'Name is must.',
         
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
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

    public function shipmentUpdateStatusForm($id){
        $invoice = Invoice::find($id);
        return view('cargo_master.shipments.create',compact('invoice'));
    }

    public function shipmentUpdateStatus(Request $request){
        $validate = $request->validate([
            'shipmentStatus' => 'required',
        ], [
           // 'branch_name.required' => 'Branch Name field is required',
            'shipmentStatus.required' => 'Shipment Status field is required.',

        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
        DB::table('shipment_status')
    }
}
