@extends('layouts.yes-cargo')
@section('title','Income-Report')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Income /</span> Report</h4>
        
        <!-- <span class="float-end">
            <a href="{{ url('accounts/inventory/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Export Pdf</a>
        </span> -->
        
    </div>
    
<div class="card-datatable table-responsive">
    <table class="table border-top">
    <thead>
        <tr>
       
        <th>Invoice#</th>
        <th>Starting Date</th>
        <th>Due Date</th>
        <th>Shipper</th>
        <th>Consignee</th>
        <th>Items Count</th>
        <th>Amount (SAR)</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($income as $rec)
        <tr>
            <td>{{ $rec->shipment_mode_slug }}</td>
            <td>{{ $rec->starting_date }}</td>
            <td>{{ $rec->due_date }}</td>
            <td>{{ $rec->customer->name }}</td>
            <td> 
                <p class="mb-0">{{ $rec->cosignee_name }}</p>
                <small>{{ $rec->cosignee_address }}</small>
            </td>
            <td>{{  $rec->invoice_item_details_count }}</td>
            <td>
                @php 
                    $totalPrice = 0; 
                    foreach($rec->invoice_item_details as $item){
                        $totalPrice += $item->price;
                    }
                    $subTotal = $totalPrice + $rec->packing_charges + $rec->box_charges + $rec->bill_charges + $rec->other_charges - $rec->discount;
                    
                    $VatInPercent = $rec->vat;
                    $vatPercentAmount = ($subTotal / 100) * $rec->vat;
                    $InvoiceAmount = $vatPercentAmount + $subTotal;
                    //$InvoicesAmountSum += $InvoiceAmount;
                   // $InvoicesSum =  $InvoicesSum + $InvoiceAmount;
                @endphp
                    {{ number_format($InvoiceAmount,2)  }}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="bg-light">
        <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="font-bold text-success">{{ 'SAR '. number_format(@$InvoicesAmountSum,2) }}</td>
        </tr>
    </tfoot>
    </table>
</div>
</div>
@section('script')

@endsection
@endsection