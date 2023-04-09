<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\BranchClients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->status != 1){
            Auth::logout();
                    Session::flush();
                    return redirect(url('login'))->withInput()->with('errorMsg','You are temporary blocked. please contact to admin');
        }
        //$data['BranchWithClientsCount'] = Branch::withCount('Clients','Invoices')->get();
        //$data['activeBranches'] =  Branch::where('status', 1)->get();
        
        if(Auth::user()->hasRole('Admin')){
            $data['BranchWithClientsCount'] = Branch::withCount('Clients','Invoices')->get();
            $data['activeBranches'] =  Branch::where('status', 1)->get();

            //$branchId = Branch::where('users_id',Auth::user()->id)->first();
            $data['Invetories'] = Inventory::all();

            //$data['Income'] =  Invoice::with('invoice_item_details')->get();
            $data['Income'] =  Invoice::with('boxes')->get();    
            $boxCharges = 0;  $totalIncome = 0;
            foreach( $data['Income'] as $key => $record ){
                foreach( $record->boxes as $key => $box ){
                    $boxCharges = $box->box_charges_as_per_kg; 
                  //  echo 'box cahrges:'. $boxCharges .'<br>';
                    $subtotal = $boxCharges + $record->packing_charges + $record->box_charges + $record->bill_charges + $record->other_charges;
                   // echo 'subtotal:'.$subtotal .'<br>';
                    $AfterDiscountAmount = $subtotal - $record->discount;
                   // echo 'AfterDiscountAmount:'.$AfterDiscountAmount .'<br>';
                    $vat_value = ($record->vat / 100) * $AfterDiscountAmount ;
                   // echo 'vat_value:'.$vat_value .'<br>';
                    $netBill = $AfterDiscountAmount + $vat_value;
                   // echo 'net bill:'. $netBill .'<br><br><br>';
                    $totalIncome += $netBill;
                }
                
            }
            $data['TotalIncome'] = (float) $totalIncome;
            return view('welcome')->with($data);
       }elseif(Auth::user()->hasRole('Branch-Admin')){

            $data['BranchWithInvoiceCount'] = Branch::withCount('Invoices')->where('users_id', Auth::user()->id)->first();
            $data['branchAdmin'] =  Branch::where(['status' => 1, 'users_id' => Auth::user()->id ])->first();
            
            $branchId = Branch::where('users_id',Auth::user()->id)->first();
            $data['branchInvetories'] = Inventory::where('branch_id',$branchId->id)->get();

            $branchClients = BranchClients::where('branches_id', $branchId->id)->get(); 
            $data['branchClientsCount'] = $branchClients->count();
            
            $data['BranchIncome'] =  Invoice::with('boxes')->where('branch_id', $branchId->id)->get();    
            $boxCharges = 0;  $totalIncome = 0;
            foreach( $data['BranchIncome'] as $key => $record ){
                foreach( $record->boxes as $key => $box ){
                    $boxCharges = $box->box_charges_as_per_kg; 
                  //  echo 'box cahrges:'. $boxCharges .'<br>';
                    $subtotal = $boxCharges + $record->packing_charges + $record->box_charges + $record->bill_charges + $record->other_charges;
                   // echo 'subtotal:'.$subtotal .'<br>';
                    $AfterDiscountAmount = $subtotal - $record->discount;
                   // echo 'AfterDiscountAmount:'.$AfterDiscountAmount .'<br>';
                    $vat_value = ($record->vat / 100) * $AfterDiscountAmount ;
                   // echo 'vat_value:'.$vat_value .'<br>';
                    $netBill = $AfterDiscountAmount + $vat_value;
                   // echo 'net bill:'. $netBill .'<br><br><br>';
                    $totalIncome += $netBill;
                }
                
            }
            $data['BranchTotalIncome'] = $totalIncome;
            return view('welcome')->with($data);
       }
      
       
    }
}
