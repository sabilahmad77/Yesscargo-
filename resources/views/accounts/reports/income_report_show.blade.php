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
            @php    
               
               $boxCharges = 0;
                @endphp

                @foreach( $rec->boxes as $key => $box )
                    @php 
                        $boxCharges += $box->box_charges_as_per_kg; 
                    
                    $subtotal = $boxCharges + $rec->packing_charges + $rec->box_charges + $rec->bill_charges + $rec->other_charges;
                    $AfterDiscountAmount = $subtotal - $rec->discount;
                    $vat_value = ($rec->vat / 100) * $AfterDiscountAmount;
                    $netBill = $AfterDiscountAmount + $vat_value;
                    $InvoicesAmountSum += $netBill;
                    @endphp

            @endforeach
            <td>
               {{ number_format( $netBill, 2) }}
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
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
        
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>
@endsection
@endsection