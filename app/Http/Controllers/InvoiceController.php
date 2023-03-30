<?php

namespace App\Http\Controllers;

use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Branch;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\BranchClients;
use App\Models\InvoiceItemDetail;
use App\Models\ShipmentBoxes;
use Illuminate\Support\Facades\Auth;
use App\Models\ShipmentWeightCharges;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use \NumberFormatter;
class InvoiceController extends Controller
{

    public function index()
    {

        if(Auth::user()->hasRole('Admin')){

            $data['InvoicesList']  = Invoice::with('boxes.boxes_items')->get();
        }else{
            $data['InvoicesList']  = Invoice::with('boxes')->where('branch_admin_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        }
        return view('accounts.invoice.index')->with($data);
    }


    public function create()
    {
        //return 123;
        //$data['item'] = Item::all();
        $data['branchId'] = Branch::where('users_id', Auth::user()->id)->first();
        $lastInvoice = Invoice::where('branch_id', $data['branchId']->id)->latest()->first();
        $data['lastInvoiceNo'] = $lastInvoice->invoice_no ?? $data['branchId']->invoicing_serial;
        ++$data['lastInvoiceNo'];

        return view('accounts.invoice.create')->with($data);
    }


    public function store(Request $request)
    {

        //return $request;
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'sales_person' => 'required',
            'shipment_mode' => 'required',
           // 'item_name' => 'required',
            'bill_charge' => 'required',
           // 'item_cost' => 'required',
            'cosig_name' => 'required',
           // 'cosig_email' => 'required',
          //  'cosig_phone1' => 'required',
            //'cosig_phone2' => 'required',
            //'cosig_pinCode' => 'required',
            'cosignee_address' => 'required',
        // ], [
        //     'name.required' => 'Name field is required.',
        //     'password.required' => 'Password field is required.',
        //     'email.required' => 'Email field is required.',
        //     'email.email' => 'Email field must be email address.'
        ]);
        $branchClientCheck = BranchClients::where(['name' => $request->name, 'branches_id' => $request->branch_id])->first();
        if($branchClientCheck == false){
            $data = array(
                'branches_id'   => $request->branch_id,
                'name'     => @$request->name,
                'email' => @$request->email,
                'city' => @$request->city,
                'pincode' => @$request->pincode,
                'phone1' => @$request->phone,
                'phone2' => @$request->phone2,
                'address' => @$request->address,
            );
            $branchClient = BranchClients::create($data);
             $customerId = $branchClient->id;
        }else{
             $customerId = $branchClientCheck->id;
        }
        $shipmentModeSlug =  $request->branch_name.$request->shipment_mode[0].$request->invoice_no;
        $data = array(
            'invoice_no'           => $request->invoice_no,
            'branch_admin_id'  => Auth::user()->id,
            'due_date'  => $request->due_dated,
            'branch_id' => $request->branch_id,
            'cosignee_name'          => $request->cosig_name,
            'cosignee_email' => $request->cosig_email,
            'cosignee_phone1'     => $request->cosig_phone1,
            'cosignee_phone2'  => $request->cosig_phone2,
            'cosignee_pincode'        => $request->cosig_pinCode,
            'cosignee_city'        => $request->cosig_city,
            'cosignee_address'        => $request->cosignee_address,
            'starting_date'         => $request->starting_date,
            'due_date'  => $request->due_dated,
            'invoice_note' => $request->invoice_note,
            'shipment_mode' =>$request->shipment_mode,
            'shipment_mode_slug' => $shipmentModeSlug,
            'customer_id'           => $customerId,
            'vat'          => $request->vat,
            'discount'              => @$request->discount,
            'other_charges'          => @$request->other_charges,
            'bill_charges'              => $request->bill_charge,
            'box_charges'  => $request->boxCharges,
            'packing_charges'  => $request->packingCharge,
            'total'        => 000

        );

        $invoiceCreated = Invoice::create($data);
        $invoiceId = $invoiceCreated->id;
        //add and link multiple boxes to invoice
        $ShipmentWeightChargesLatest = ShipmentWeightCharges::latest()->first();
        foreach($request->box as $key => $boxData){

            $boxesRecord =  array(
                    'box_name'    => $boxData[0],
                    'box_weight'  => $boxData[1],
                    'invoice_id'  => $invoiceId,
                    'current_shipment_rate_per_kg' => $ShipmentWeightChargesLatest->price,
                    'box_charges_as_per_kg' => $ShipmentWeightChargesLatest->price * $boxData[1],
                );
                $shipmentBoxRecord = ShipmentBoxes::create($boxesRecord);
                $shipmentBoxLatestId = $shipmentBoxRecord->id;
            foreach($request->list[$key] as $index => $record){

                $boxesItemsRecord =  array(
                    'item_name'    => $record['0'],
                    'quantity'  => $record['1'],
                    'item_per_cost'  => $record['2'],
                    'invoices_id' => $invoiceId,
                    'box_id'  => $shipmentBoxLatestId
                );
                $shipmentBoxRecord = InvoiceItemDetail::create($boxesItemsRecord);

            }

        }
        return redirect('accounts/invoice');

        //latest shipment charges per Kg

        // $ShipmentWeightChargesLatest = ShipmentWeightCharges::latest()->first();
        // foreach($request->item_name as $key => $record){
        //     $data = array(
        //         'invoices_id'   => $invoiceId,
        //         'item_name'     => @$request->item_name[$key],
        //         'quantity' => @$request->item_quantity[$key],
        //         'weight' => @$request->item_weight[$key],
        //         'boxes' => @$request->item_box[$key],
        //         // 'item_per_cost' => @$request->item_cost[$key],
        //         'item_per_cost' => 0.00,
        //         'discount' => 0.00,
        //         'item_box' => @$request->item_discount[$key],
        //         //'price' => @$request->item_cost[$key],
        //         'price' => $request->item_cost[$key] ,
        //     );
        //     $invoiceCreated = InvoiceItemDetail::create($data);
        // }

        return redirect('accounts/invoice');
    }


    public function show($id)
    {
        $invoice = Invoice::with('boxes', 'boxes.boxes_items', 'branch_admin', 'customer')->find($id);
        $totalNoOfPieces = 0;
        foreach($invoice->invoice_item_details as $key => $item){

            $totalNoOfPieces += $item->quantity;

        }

        $boxesWeight = 0;  $boxShipmentCharges = 0;
        foreach($invoice->boxes as $key => $boxRecord){

            $boxesWeight += $boxRecord->box_weight;
            $boxShipmentCharges += $boxRecord->box_charges_as_per_kg;

        }
        $BeforeDiscountAmount = $boxShipmentCharges + $invoice->packing_charges + $invoice->box_charges + $invoice->bill_charges + $invoice->other_charges;
        $AfterDiscountAmount = $BeforeDiscountAmount - $invoice->discount;
        $vat_value = ($AfterDiscountAmount / 100);
        $vat_value *= $invoice->vat;
        $netBill = $AfterDiscountAmount + $vat_value;

        $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
       
        $amountString = $digit->format($netBill,2);
        return view('accounts.invoice.show',compact(['boxesWeight','boxShipmentCharges','amountString','invoice', 'totalNoOfPieces', 'vat_value', 'netBill']));
    }


    public function edit($id)
    {
        $invoice = Invoice::with(['invoice_item_details', 'boxes.boxes_items', 'customer'])->find($id);

        return view('accounts.invoice.edit', compact('invoice'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_no'        => ['required'],
            'cosignee_name'     => ['required'],
            'cosignee_email'    => ['required'],
            'cosignee_phone1'   => ['required'],
            'cosignee_phone2'   => ['required'],
            'cosignee_pincode'  => ['required'],
            'cosignee_city'     => ['required'],
            'cosignee_address'  => ['required'],
            'invoice_note'      => ['required'],
            'due_date'          => ['required'],
            'discount'          => ['required'],
            'shipment_mode'     => ['required'],
            'vat'               => ['required'],
            'other_charges'     => ['required'],
            'bill_charges'      => ['required'],
            'packing_charges'   => ['required'],
            'box_charges'       => ['required'],
            'starting_date'     => ['required'],
            'box'               => ['required'],
            'list'              => ['required'],

            'customer.name'   => 'required|string',
            'customer.email'  => 'required|email',
            'customer.phone1' => 'required|string',
            'customer.phone2' => 'required|string',
            'customer.city'   => 'required|string',
            'customer.pincode'=> 'required|string',
            'customer.address'=> 'required|string',

        ]);

        $invoice = Invoice::find($id);

        $invoice->update($request->except('box', 'list', 'customer'));

        $invoice->customer->update($request->customer);

        $ShipmentWeightChargesLatest = ShipmentWeightCharges::latest()->first();

        foreach ($request->box as $key => $boxData) {

            $box = $invoice->boxes()->updateOrCreate(
                [
                    'id' => $boxData['box_id']
                ],
                [
                    'box_name'                     => $boxData['box_name'],
                    'box_weight'                   => $boxData['box_weight'],
                    'current_shipment_rate_per_kg' => $ShipmentWeightChargesLatest->price,
                    'box_charges_as_per_kg'        => $ShipmentWeightChargesLatest->price * $boxData['box_weight'],
                ]
            );

            if ($box) {

                $box->boxes_items()->delete();

                foreach ($request->list[$key] as $item) {

                    $box->boxes_items()->create([
                        'invoices_id'   => $invoice->id,
                        'box_id'        => $box->id,
                        'item_name'     => $item[0],
                        'quantity'      => $item[1],
                        'item_per_cost' => $item[2]
                    ]);
                }
            }
        }

        return redirect()->route('invoice.index');
    }


    public function destroy($id)
    {
        //
    }

    public function downloadInvoice($id){

        $invoice = Invoice::with(['invoice_item_details', 'boxes.boxes_items', 'branch_admin', 'customer'])->find($id);

        $totalNoOfPieces = $invoice->invoice_item_details->sum('quantity');
        $boxesWeight = $invoice->boxes->sum('box_weight');
        $boxShipmentCharges = $invoice->boxes->sum('box_charges_as_per_kg');

        $BeforeDiscountAmount = $boxShipmentCharges + $invoice->packing_charges + $invoice->box_charges + $invoice->bill_charges + $invoice->other_charges;
        $AfterDiscountAmount = $BeforeDiscountAmount - $invoice->discount;
        $vat_value = ($AfterDiscountAmount / 100);
        $vat_value *= $invoice->vat;
        $netBill = $AfterDiscountAmount + $vat_value;
        $digit = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $amountString = $digit->format($netBill, 2);
        $qrcode = base64_encode(QrCode::format('svg')->size(120)->errorCorrection('H')->generate( 'Invoice # => '.$invoice->shipment_mode_slug.','.'Shipment Date => '.$invoice->starting_date.','.'Consignee => '.$invoice->cosignee_name.','.'Amount =>'.$netBill ) );
        // $pdf = Pdf::loadView('accounts.invoice.pdf', array('qrcode' => $qrcode,'boxesWeight' => $boxesWeight,  'boxShipmentCharges' => $boxShipmentCharges,'amountString' => $amountString, 'invoice' => $invoice, 'totalNoOfPieces' => $totalNoOfPieces,  'vat_value'=>$vat_value, 'netBill' => $netBill ))->setPaper('a4', 'portrait')->save(public_path('invoices/pdf/'.'Invoice_'.$invoice->shipment_mode_slug.'.pdf'));

        $renderHtml = view('accounts.invoice.pdf-new', ['qrcode' => $qrcode,'boxesWeight' => $boxesWeight,  'boxShipmentCharges' => $boxShipmentCharges,'amountString' => $amountString, 'invoice' => $invoice, 'totalNoOfPieces' => $totalNoOfPieces,  'vat_value'=>$vat_value, 'netBill' => $netBill ])->render();

        $arabic = new Arabic();
        $p = $arabic->arIdentify($renderHtml);

        for ($i = count($p) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $arabic->utf8Glyphs(substr($renderHtml, $p[$i - 1], $p[$i] - $p[$i - 1]));
            $renderHtml = substr_replace($renderHtml, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        }

        $pdf = PDF::loadHTML($renderHtml);

        return $pdf->download(sprintf('Invoice_%s.pdf', $invoice->shipment_mode_slug));
    }

    public function shipmentDueDate(Request $request){
        $value = $request->value;
        if($value ==='Air cargo'){
            $currentDateTime = Carbon::now();
            return $newDateTime = Carbon::now()->addDays(20)->format('Y-m-d');
        }elseif($value ==='Budget cargo'){
            $currentDateTime = Carbon::now();
            return $newDateTime = Carbon::now()->addDays(50)->format('Y-m-d');
        }elseif($value ==='Road cargo'){
            $currentDateTime = Carbon::now();
            return $newDateTime = Carbon::now()->addDays(30)->format('Y-m-d');
        }
    }
}
