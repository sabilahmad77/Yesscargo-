<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Invoice; 
use App\Models\Inventory; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function ReportsIndexPage(){

        $data['branchId'] = Branch::where('users_id', Auth::user()->id)->first();
        $data['branches'] = Branch::where('status', 1)->get();
        return view('accounts.reports.index')->with($data);
        
    }

    public function ReportShow(Request $request){
        $branchId = $request->branchId;
        $from = $request->start_date;
        $to = $request->end_date;
        if($request->reportType === 'IncomeReport'){
            $data['income'] =  Invoice::with('invoice_item_details','customer')->withCount('invoice_item_details')->whereRaw(
                "(created_at >= ? AND created_at <= ?)", 
                [
                    $from ." 00:00:00", 
                    $to ." 23:59:59"
                ]
                )->where('branch_id', $branchId)
                ->get();
            $totalWeight = 0; $totalNoOfPieces = 0; $totalNoOfBoxes = 0;  $totalPrice = 0;
              
             foreach($data['income'] as $orders){
                 foreach($orders->invoice_item_details as $key => $item){
                     $totalPrice += $item->price;
                 }
             }
            return view('accounts.reports.income_report_show')->with($data);
        }else if($request->reportType ==='InventoryReport'){

            $data['inventory'] =  Inventory::with('category','branch')->whereRaw(
                "(created_at >= ? AND created_at <= ?)", 
                [
                    $from ." 00:00:00", 
                    $to ." 23:59:59"
                ]
                )->where('branch_id', $branchId)
                ->get();
            return view('accounts.reports.inventory_report_show')->with($data);
        }
    }
}
