<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; 
class AccountsController extends Controller
{
    public function invoiceList(){

        return view('accounts.invoice-index');
    }

    public function downloadInvoice($Oid){
        //return $Oid;
        //$order=Order::find($oid);
	    //$invoice_date = date('jS F Y', strtotime($order->invoice_date)); 
        $pdf = PDF::loadView('accounts.invoice_template');
        return $pdf->download('Invoice_'.config('app.name').'_Order_No#'.$Oid.'.pdf');
    
    }
}
