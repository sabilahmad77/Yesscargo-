@extends('layouts.yes-cargo')
@section('title','Inventory-Report')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Inventory /</span> Report</h4>
        
        <!-- <span class="float-end">
            <a href="{{ url('accounts/inventory/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Export Pdf</a>
        </span> -->
        
    </div>
    
    <span style=" padding:0px 10px; 10px 10px;">
    <table id="example" class="display nowrap" style="width:100%;">
    <thead>
        <tr>
       
        <th>SR#</th>
        <th>Activity</th>
        <th class="text-truncate">Amount (SAR)</th>
        <th>Paid To</th>
        <th>Category</th>
        <!-- <th>Branch</th> -->
        <th>Payment Date</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $totalInventory = 0;
        @endphp
        @foreach($inventory as $key => $invetory)
            @php
                $totalInventory += $invetory->amount;
            @endphp
        <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $invetory->name }}</td>
        <td>{{ number_format($invetory->amount,2) }}</td>
        <td>{{ $invetory->paid_to }}</td>
        <td>{{ $invetory->category->name }}</td>
        <!-- <td>{{ $invetory->branch->branch_name }}</td> -->
        <td>{{ $invetory->created_at }}</td>
       
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="bg-light">
            <td></td>
            <td></td>
            <td>{{ 'SAR '. number_format($totalInventory,2) }}</td>
            <td></td>
            <td></td>
            <td></td>
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