@extends('layouts.yes-cargo')
@section('title','Return-Box-List')
@section('content')

<div class="card">
    <div class="card-header pb-2">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Return Box /</span> List</h4>
        @if( Auth::user()->hasRole('Branch-Admin')  )
        <span class="float-end">
            <a href="{{ url('cargo-master/return-box/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Add</a>
        </span>
        @endif
    </div>
    
    <span style=" padding:0px 10px; 10px 10px;">
    <table id="example" class="display nowrap" style="width:100%;">
    <thead>
        <tr>
        
        <th>SR#</th>
        <th>Invoice#</th>
        <th >PCS</th>
        <th>Consignee</th>
        <th>Description Of Goods</th>
        <th >Weight(kg)</th>
        
        </tr>
    </thead>
    <tbody>
        @foreach($returnBoxes as $key => $record)
        <tr>
           <td>{{ ++$key }}</td>
           <td>{{ $record->invoice->invoice_no }}</td>
           <td>{{ $record->invoiceItem->quantity }}</td>
           <td>{{ $record->invoice->cosignee_name }}</td> 
           <td>{{ $record->invoiceItem->item_name }}</td>
           <td>{{ $record->invoiceItem->weight }}</td>
           
        </tr>
        @endforeach
    </tbody>
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