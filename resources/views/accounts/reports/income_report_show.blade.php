@extends('layouts.yes-cargo')
@section('title','Income-Report')
@section('content')

<div class="card">
    <div class="card-header p-3">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Income /</span> Report</h4>
        
        <!-- <span class="float-end">
            <a href="{{ url('accounts/inventory/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Export Pdf</a>
        </span> -->
        
    </div>
    
    <span style=" padding:0px 10px; 10px 10px;">
    <table id="example" class="display nowrap" style="width:100%;">
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
        @php $InvoicesAmountSum = 0 ; @endphp
        @foreach($income as $rec)
        <tr>
            <td>{{ $rec->shipment_mode_slug }}</td>
            <td>{{ date('d/m/Y', strtotime($rec->starting_date)) }}</td>
            <td>{{ date('d/m/Y', strtotime($rec->due_date)) }}</td>
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
                    $InvoicesAmountSum += $InvoiceAmount;
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
            <td class="font-bold text-success"> <b> {{ 'SAR '. $InvoicesAmountSum }} </b></td>
        </tr>
    </tfoot>
    </table>
</span>
</div>
@section('script')

<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }
            },
        
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>
@endsection
@endsection