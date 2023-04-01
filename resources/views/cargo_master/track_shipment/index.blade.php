@extends('layouts.yes-cargo')
@section('title','Track Shipment')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Track /</span> Shipment</h4>
        
        <form action="{{ url('cargo-master/shipments/search')}}" method="POST"class="card-body">
            @csrf
            <!-- <h6>1. Account Details</h6> -->
            <div class="row g-3">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="multicol-username">Invoice <span class="text-danger">*</span></label>
                    <input type="text"    name="invoice_number" id="multicol-username" class="form-control" Placeholder="Add Invoice No"/>
                </div>
                <!-- <div class="col-md-4">
                    <label class="form-label" for="multicol-username">Shipper ID</label>
                    <input type="text" name="branch_name" id="multicol-username" class="form-control" Placeholder="Add Shipper ID"/>
                </div> -->
                <div class="col-md-4">
                    <label class="form-label" for="multicol-username">Consignee Phone</label>
                    <input type="text" name="consignee_phone" id="multicol-username" class="form-control" Placeholder="Add Consignee Phone"/>
                </div>
            </div>
            <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary">Cancel</button>
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
                <td>{{ $shipment->starting_date }}</td>
                <td>{{ $shipment->due_date }}</td>
                <td>
                    
                    <select name="shipmentStatus" class="form-control updateStatus bg-light">
                        <option class="bg-light" value="{{ $shipment->shipment_status }}" selected>{{ $shipment->shipment_status }}</option>
                        
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endif
@section('script')

@endsection
@endsection