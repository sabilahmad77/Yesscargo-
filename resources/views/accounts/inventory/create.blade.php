@extends('layouts.yes-cargo')
@section('title','Inventory-Create')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Add Inventory</h5>
    
<form action="{{ url('accounts/inventory') }}" method="POST"class="card-body">
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
        <label class="form-label" for="multicol-username">Activity Name</label>
        <input type="text" name="name"  class="form-control" placeholder="Add Activity Name" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-username">Category</label>
        <select name="cat_id" class="form-control">
            
            @foreach($categories as $cat)
                @if($loop->first)
                    <option value="">--Select Category--</option>
                @endif
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Amount</label>
        <div class="input-group input-group-merge">
            <input type="number" step="any" name="amount" id="multicol-email" class="form-control" placeholder="Add Amount"  />
        </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Paid To</label>
        <div class="input-group input-group-merge">
            <input type="text" name="paid_to" id="multicol-email" class="form-control" placeholder="Add Reciver Name"  />
        </div>
    </div>
    
    <!-- <div class="col-md-6">
        <label class="form-label" for="multicol-email">Paid to Email</label>
            <div class="input-group input-group-merge">
                <input type="text" name="paid_to_email" id="multicol-email" class="form-control" placeholder="Add Reciver Email"   />
                
            </div>
    </div> -->
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone to Phone</label>
            <div class="input-group input-group-merge">
                <input type="text" name="paid_to_phone1"  class="form-control" placeholder="Add phone 1"/>
            </div>
    </div>
    <!-- <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone to Phone 2</label>
            <div class="input-group input-group-merge">
                <input type="text" name="paid_to_phone2"  class="form-control" placeholder="Add phone 2" />
            </div>
    </div> -->
   
    <!-- <div class="col-md-12">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-confirm-password">Short Description</label>
        <div class="input-group input-group-merge">
            <textarea type="text" name="short_description"  class="form-control" placeholder="Add Short Description"></textarea>
        </div>
        </div>
    </div> -->
    <div class="col-md-12">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-confirm-password">Description</label>
        <div class="input-group input-group-merge">
            <textarea type="text" name="description" class="form-control" placeholder="Add  Description"></textarea>
        </div>
        </div>
    </div>
    </div>
    <div class="pt-4">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
</form>
</div>
@endsection