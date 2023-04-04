<?php

namespace App\Http\Controllers;

//use PDF; 
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Branch;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Exports\ManifestExport;

class ManifestController extends Controller
{
    
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            $data['branches'] = Branch::all();
          
       }elseif(Auth::user()->hasRole('Branch-Admin')){
            $data['branches'] = Branch::where('users_id',Auth::user()->id)->first();
           
       }
       //return $data['branches'];
        return view('accounts.manifest.index')->with($data);
    }

    
    public function create(Request $request)
    {
        //return $request;
        $branchId = $request->branchId;
        $from = $request->start_date;
        $to = $request->end_date;
        $order =  Invoice::with('boxes.boxes_items','customer')->whereRaw(
            "(created_at >= ? AND created_at <= ?)", 
            [
                $from ." 00:00:00", 
                $to ." 23:59:59"
            ]
            )->where('branch_id', $branchId)->get();
            
          $boxesTotalWeight = 0; $totalNoOfPieces = 0; $totalNoOfBoxes = 0; 
          
        foreach($order as $orders){
            foreach($orders->invoice_item_details as $key => $item){
                $totalNoOfPieces += $item->quantity;
            }
            foreach($orders->boxes as $key => $box){
                $totalNoOfBoxes++;
                $boxesTotalWeight += $box->box_weight;
            }
        }
        return view('accounts.manifest.show',compact(['order', 'boxesTotalWeight', 'totalNoOfBoxes','totalNoOfPieces', 'from','to', 'branchId']));

    }

   
    public function store(Request $request)
    {
       
    }

   
    public function show($id)
    {
        return view('accounts.manifest.show');
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }

    public function downloadManifestPDF(Request $request){
       
        $from = $request->start_date;
        $to = $request->end_date;
        $branchId = $request->branchId;
        $order = Invoice::with('boxes','invoice_item_details')->withCount('invoice_item_details')->whereRaw(
            "(created_at >= ? AND created_at <= ?)", 
            [
            $from ." 00:00:00", 
            $to ." 23:59:59"
            ]
        )->where('branch_id', $branchId)->get();
        
        $boxesTotalWeight = 0; $totalNoOfPieces = 0; $totalNoOfBoxes = 0; 
          
        foreach($order as $orders){
            foreach($orders->invoice_item_details as $key => $item){
                $totalNoOfPieces += $item->quantity;
            }
            foreach($orders->boxes as $key => $box){
                $totalNoOfBoxes++;
                $boxesTotalWeight += $box->box_weight;
            }
        }
       //['order', 'boxesTotalWeight', 'totalNoOfBoxes','totalNoOfPieces', 'from','to', 'branchId']
        $pdf = PDF::loadView('accounts.manifest.download_pdf', array('order' => $order, 'boxesTotalWeight' => $boxesTotalWeight, 'totalNoOfBoxes' => $totalNoOfBoxes, 'totalNoOfPieces' => $totalNoOfPieces, 'from' => $from, 'to'=> $to));
        return $pdf->download('Manifest-From-'.$from.'-To-'.$to.'.pdf');
    }

    public function downloadManifestExcell(Request $request){
        $from = $request->start_date;
        $to = $request->end_date;
        $branchId = $request->branchId;
        return Excel::download(new ManifestExport($request), 'Manifest-'.$request->start_date.'-to-'.$request->end_date.'.xlsx');
    }
}
