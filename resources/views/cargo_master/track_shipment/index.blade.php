@extends('layouts.yes-cargo')
@section('title','Track Shipment')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Track /</span> Shipment</h4>
        
        <form action="{{ url('cargo-master/shipments/search')}}" method="POST"class="card-body px-0">
            @csrf
            <!-- <h6>1. Account Details</h6> -->
            <div class="row g-3">
                <div class="col-md-12">
                    
                   
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Opps!</strong> Please fill any field!
                        
                    </div>
                    @endif
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="multicol-username">Invoice <span class="text-danger">*</span></label>
                    <input type="text"    name="invoice_number" id="multicol-username" class="form-control" @if(isset($shipment) ) value="{{ $shipment->invoice_no }}" @endif Placeholder="Add Invoice No"/>
                </div>
                
                <div class="col-md-4 pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>
            </div>
           
        </form>
    </div>
    
</div>
@if(isset($shipment) )
<div class="card mt-3">
    <div class="card-header">
    <table class="table border-top">
        <thead class="bg-light">
            <tr>
            <th>HAWB</th>
            <th>Shipper City</th>
            <th>Consignee</th>
            <th>Starting Date</th>
            <th class="text-truncate">Due Date</th>
            <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td >{{ $shipment->shipment_mode_slug }}</td>
                <td>{{ $shipment->customer->city }}</td>
                <td>{{ $shipment->cosignee_name }}</td>
                <td>{{ date('d/m/Y', strtotime($shipment->starting_date)) }}</td>
                <td>{{ date('d/m/Y', strtotime($shipment->due_date)) }}</td>
                <td class="text-center bg-primary text-white"> {{ $shipment->shipment_status }}
                </td>
            </tr>
            
        </tbody>
    </table>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
    <table class="table border-top">
        <thead class="bg-light">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Remarks</th>
                <th class="text-center" style="width: 25%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shipment->shipmentStatuses as $status)
            <tr>
                <td >{{  date('d/m/Y', strtotime($status->dated )) }}</td>
                <td >{{  date('h:i:s', strtotime($status->dated )) }}</td>
                <td>{{ $status->remarks }}</td>
                <td class="text-center bg-primary text-white"> <b> {{ $status->status }} </b>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

@endif
@section('script')

@endsection
@endsection