@extends('layouts.yes-cargo')
@section('title','Update Shipment Status')
@section('content')
<div class="card mb-4">
  
<form action="{{ url('cargo-master/shipments/change-status/') }}" method="POST" class="card-body">
    @csrf
    
    <div class="row g-3">
    <div class="col-md-3">
        <label class="form-label" for="multicol-username">HAWB</label>
        <input type="text"   class="form-control" value="{{ $invoice->shipment_mode_slug }}" readonly/>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">Shipper Name </label>
        <div class="input-group input-group-merge">
            <input type="text" class="form-control" value="{{ $invoice->customer->name }}" readonly/>
        </div>
       
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">Consignee Name </label>
        <div class="input-group input-group-merge">
            <input type="text"  class="form-control" value="{{ $invoice->cosignee_name }}" readonly/>
        </div>
       
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">Ending Date</label>
            <div class="input-group input-group-merge">
                <input type="text"   class="form-control" value="{{ $invoice->due_date  }}" readonly />
                
            </div>
    </div>
    <div class="col-md-3">
        <!-- <label class="form-label" for="multicol-email">UserName</label>
            <div class="input-group input-group-merge">
                <input type="text" name="userName"  class="form-control"  value="{{ old('userName')  }}" placeholder="Add UserName"  aria-describedby="multicol-email2" />
                
            </div> -->
    </div>
    <div class="col-sm-12">
    <label class="form-label" for="multicol-email">Shipment Status</label>
        <select name="shipmentStatus" class="form-control updateStatus">
            
            <option value="Shipment Booked" >Shipment Booked</option>
            <option value="Ready to Load">Ready to Load </option>
            <option value="Moving to India">Moving to India</option>
            <option value="On the Way">On the Way</option>
            <option value="Shipmemnt Arrived">Shipmemnt Arrived</option>

            <option value="Waiting for Customs Clearance">Waiting for Customs Clearance</option>
            <option value="Shipment Cleared">Shipment Cleared</option>
            <option value="Shipment out for Delivery">Shipment out for Delivery</option>
            <option value="Shipment Delivared">Shipment Delivared</option>
            <option value="Custom Close">Custom Close</option>
            <option value="Custom Delay">Custom Delay</option>
            <option value="Reached at Port">Reached at Port</option>
            <option value="Action Taken on Complaint">Action Taken on Complaint</option>
            <option value="Shipment Connected">Shipment Connected</option>
        </select>
        @error('shipmentStatus')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-sm-12">
        <label class="form-label" for="multicol-email">Remarks</label>
        <textarea name="remarks" value="{{ old('remarks') }}" cols="30" rows="2" class="form-control">
            {{ old('remarks') }}
        </textarea>
    </div>
    </div>
    <div class="pt-4">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
    <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
</form>
</div>
@endsection