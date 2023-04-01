<?php
namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use ArPHP\I18N\Arabic;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Branch;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\BranchClients;
use App\Models\InvoiceItemDetail;
use App\Models\ShipmentBoxes;
use Illuminate\Support\Arr;
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
        $branch = Branch::with('Clients')->where('users_id', Auth::id())->first();
        $lastInvoiceNo = Invoice::query()->where('branch_id', $branch?->id)->orderByDesc('created_at')->value('invoice_no');
        $lastInvoiceNo = $lastInvoiceNo ?? $branch->invoicing_serial;
        $branchClients = $branch->Clients()->get();

        return view('accounts.invoice.create', compact('branch', 'lastInvoiceNo', 'branchClients'));
    }


    public function store(InvoiceRequest $request)
    {
        $branchClient = BranchClients::updateOrCreate(
            [
                'name'        => $request->get('shipper.name'),
                'branches_id' => $request->branch_id,
            ],
            $request->get('shipper')
        );

        $customerId = $branchClient->id;

        $branchName   = filter_var($request->branch_name, FILTER_SANITIZE_STRING);
        $shipmentMode = filter_var($request->shipment_mode, FILTER_SANITIZE_STRING);
        $invoiceNo    = filter_var($request->invoice_no, FILTER_SANITIZE_STRING);

        // Concatenate the values using a separator
        $shipmentModeSlug = $branchName . '' . $shipmentMode . '' . $invoiceNo;

        $request->merge([
            'branch_admin_id'    => Auth::id(),
            'branch_id'          => $request->branch_id,
            'shipment_mode_slug' => $shipmentModeSlug,
            'customer_id'        => $customerId,
            'total'              => 0,
        ]);

        $invoice = Invoice::create($request->except('shipper', 'box'));

        $ShipmentWeightChargesLatest = ShipmentWeightCharges::latest()->first();

        foreach($request->box as $boxData){
            $shipmentBox = ShipmentBoxes::create([
                'box_name'                     => $boxData['box_name'],
                'box_weight'                   => $boxData['box_weight'],
                'invoice_id'                   => $invoice->id,
                'current_shipment_rate_per_kg' => $ShipmentWeightChargesLatest->price,
                'box_charges_as_per_kg'        => $ShipmentWeightChargesLatest->price * $boxData['box_weight'],
            ]);

            foreach($boxData['items'] as $item){
                InvoiceItemDetail::create([
                        'item_name'     => $item['item_name'],
                        'quantity'      => $item['quantity'],
                        'item_per_cost' => $item['item_per_cost'],
                        'invoices_id'   => $invoice->d,
                        'box_id'        => $shipmentBox->id
                    ]);
            }

        }
        return redirect(route('invoice.index'));
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
        $branch = Branch::with('Clients')->where('users_id', Auth::id())->first();
        $branchClients = $branch->Clients()->get();

        return view('accounts.invoice.edit', compact('invoice', 'branchClients'));
    }


    public function update(InvoiceRequest $request, $id)
    {
        $invoice = Invoice::find($id);

        $invoice->update($request->except('box', 'shipper', '_token', '_method'));

        $invoice->customer()->update($request->shipper);

        $ShipmentWeightChargesLatest = ShipmentWeightCharges::latest()->first();

        foreach ($request->box as $key => $boxData) {

            $box = $invoice->boxes()->updateOrCreate(
                [
                    'id'                           => Arr::get($boxData, 'box_id', 0)
                ],
                [
                    'box_name'                     => $boxData['box_name'],
                    'box_weight'                   => $boxData['box_weight'],
                    'current_shipment_rate_per_kg' => $ShipmentWeightChargesLatest->price,
                    'box_charges_as_per_kg'        => $ShipmentWeightChargesLatest->price * $boxData['box_weight'],
                ]
            );

            $box->boxes_items()->delete();

            foreach($boxData['items'] as $item) {
                InvoiceItemDetail::create([
                    'item_name'     => $item['item_name'],
                    'quantity'      => $item['quantity'],
                    'item_per_cost' => $item['item_per_cost'],
                    'invoices_id'   => $invoice->d,
                    'box_id'        => $box->id
                ]);
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

        $days = match ($request->value) {
            'Budget cargo' => 50,
            'Road cargo'   => 30,
            default        => 20,
        };

        return now()->addDays($days)->format('d/m/Y');
    }
}

