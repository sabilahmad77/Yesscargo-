@extends('layouts.yes-cargo')
@section('title','Return-Box-List')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Return Box /</span> List</h4>
        @if( Auth::user()->hasRole('Branch-Admin')  )
        <span class="float-end">
            <a href="{{ url('cargo-master/return-box/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Add</a>
        </span>
        @endif
    </div>
    
<div class="card-datatable table-responsive">
    <table class="table border-top">
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
</div>
</div>
@section('script')

@endsection
@endsection