<?php

namespace App\Exports;

use App\Models\Invoice;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
//use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class ManifestExport implements FromView
{
    private $request;

    public function __construct($request) 
    {
        $this->from = $request->start_date;
        $this->to = $request->end_date;
        $this->branchId = $request->branchId;
    }
    
    // // public function headings(): array
    // // {
    // //     return ["#", "HWB CODE", "NUMBER OF BOXES", "RECEIVER NAME & ADDRESS", "DESCRIPTION OF ITEMS", "WEIGHT"];
    // // }

    // // public function registerEvents(): array
    // // {
    // //     return [
    // //         AfterSheet::class    => function(AfterSheet $event) {
    // //             $cellRange = 'A1:W1'; // All headers
    // //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(18);
    // //         },
    // //     ];
    // // }
    
    // // public function collection()
    // // {
    // //     return $this->$request->members();
    // //     //return Invoice::all();
    // //     // $from = $request->start_date;
    // //     // $to = $request->end_date;
    // //     // $branchId = $request->branchId;
    // //     return $order = Invoice::with('invoice_item_details','customer')->withCount('invoice_item_details')->whereRaw(
    // //         "(created_at >= ? AND created_at <= ?)", 
    // //         [
    // //             $this->from ." 00:00:00", 
    // //             $this->to ." 23:59:59"
    // //         ]
    // //       )->where('branch_id', $this->branchId)->get();
    // //       //->select('invoice_no', 'shipment_mode_slug',)->get();
    // // }

    // // public function map($members): array
    // // {
    // //     return [
    // //         1,
    // //         $members->shipment_mode_slug,
    // //         $members->team_number,
    // //         $members->date_of_birth,
    // //     ];
    // // }

    // public function collection()

    // {

    //     //returns Data with User data, all user data, not restricted to start/end dates

    //     return $data['order'] = Invoice::with('invoice_item_details','customer')->withCount('invoice_item_details')->whereRaw(
    //             "(created_at >= ? AND created_at <= ?)", 
    //             [
    //                 $this->from ." 00:00:00", 
    //                 $this->to ." 23:59:59"
    //             ]
    //             )->where('branch_id', $this->branchId)
    //             ->select( 'customer_id', 'shipment_mode_slug', 'customer_id')
    //             ->get();

    //         $totalWeight = 0; $totalNoOfPieces = 0; $totalNoOfBoxes = 0;
            
    //         foreach($data['order'] as $orders){
    //             foreach($orders->invoice_item_details as $key => $item){
    //                 $totalWeight += $item->weight;
    //                 $totalNoOfPieces += $item->quantity;
    //                 $totalNoOfBoxes += $item->boxes;
    //             }
    //         }
    //         $data['totalWeight'] = $totalWeight ;
    //         $data['totalNoOfPieces'] = $totalNoOfPieces;
    //         $data['totalNoOfBoxes'] = $totalNoOfPieces;
    //         return $data;

    // }

 

    // public function map($data) : array {

    //     return [

    //         $order['order']->id,

    //         $order['order']->shipment_mode_slug,
           
    //         $order['order']->customer->name,
    //         $order['order']->customer->address,
    //       //  $order['order']->customer->city,
    //         $order['order']->invoice_item_details->item_name,
    //         $order['totalWeight']

    //         // Carbon::parse($registration->event_date)->toFormattedDateString(),

    //         // Carbon::parse($registration->created_at)->toFormattedDateString()

    //     ] ;

 

 

    // }

 

    // public function headings() : array {

    //     return [

    //        'SR.',

    //        'HWB CODE',

    //        'NUMBER OF BOXES',

    //        'RECEIVER NAME & ADDRESS',

    //        'DESCRIPTION OF ITEMS',

    //        'WEIGHT'

    //     ] ;

    // }

    public function view(): View
    {
        // $data['order'] = Invoice::with('invoice_item_details','customer')->withCount('invoice_item_details')->whereRaw(
        //         "(created_at >= ? AND created_at <= ?)", 
        //         [
        //             $this->from ." 00:00:00", 
        //             $this->to ." 23:59:59"
        //         ]
        //         )->where('branch_id', $this->branchId)
        //         ->get();

        //     $totalWeight = 0; $totalNoOfPieces = 0; $totalNoOfBoxes = 0;
            
        //     foreach($data['order'] as $orders){
        //         foreach($orders->invoice_item_details as $key => $item){
        //             $totalWeight += $item->weight;
        //             $totalNoOfPieces += $item->quantity;
        //             $totalNoOfBoxes += $item->boxes;
        //         }
        //     }
        //     $data['totalWeight'] = $totalWeight ;
        //     $data['totalNoOfPieces'] = $totalNoOfPieces;
        //     $data['totalNoOfBoxes'] = $totalNoOfPieces;
        //     $data['from'] = $this->from;
        //     $data['to'] = $this->to;
        $data['order'] =  Invoice::with('boxes','invoice_item_details','customer')->withCount('invoice_item_details')->whereRaw(
            "(created_at >= ? AND created_at <= ?)", 
            [
                $this->from ." 00:00:00", 
                $this->to ." 23:59:59"
            ]
            )->where('branch_id', $this->branchId)
            ->get();
            
          $boxesTotalWeight = 0; $totalNoOfPieces = 0; $totalNoOfBoxes = 0; 
          
        foreach($data['order'] as $orders){
            foreach($orders->invoice_item_details as $key => $item){
                $totalNoOfPieces += $item->quantity;
            }
            foreach($orders->boxes as $key => $box){
                $totalNoOfBoxes++;
                $boxesTotalWeight += $box->box_weight;
            }
        }
        $data['boxesTotalWeight'] = $boxesTotalWeight ;
        $data['totalNoOfPieces'] = $totalNoOfPieces;
        $data['totalNoOfBoxes'] = $totalNoOfBoxes;
        $data['from'] = $this->from;
        $data['to'] = $this->to;
        return view('accounts.manifest.export_excel')->with($data);
    }
   
}


