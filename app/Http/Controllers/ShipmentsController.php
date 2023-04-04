<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $now = Carbon::now()->format('Y-m-d');
        $statusUpdate =DB::table('shipment_status')->insert(
            ['invoice_id' => $request->invoice_number, 'shipment_mode_slug'=> $request->shipment_mode_slug, 'dated' => Carbon::now()->toDateTimeString() , 'remarks' => $request->remarks , 'status' => $request->shipmentStatus]
            );
        $statusUpdateInInvoice =DB::table('invoices')->where('invoice_no', $request->invoice_number)
        ->update([
            'shipment_status' => $request->shipmentStatus
        ]);
        if($statusUpdate && $statusUpdateInInvoice){
            return redirect('cargo-master/shipments')->with('success', 'Record updated successfully!');
        }
            
    }
}
