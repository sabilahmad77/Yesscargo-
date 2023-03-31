@extends('layouts.yes-cargo')
@section('title','Add-Client')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Add New Client</h5>
<form action="{{ url('/clients') }}" method="POST"class="card-body">
    @csrf
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
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Client Name</label>
        <input type="text" name="name" id="multicol-username" class="form-control" value="{{ $userData->name }}"/>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Email</label>
            <div class="input-group input-group-merge">
                <input type="email" name="email" id="multicol-email" class="form-control" value="{{ $userData->email }}" />
            </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone 1</label>
            <div class="input-group input-group-merge">
                <input type="text" name="phone1" id="multicol-email" class="form-control"  value="{{ $userData->phone1 }}"/>
                
            </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone 2</label>
            <div class="input-group input-group-merge">
                <input type="text" name="phone2" id="multicol-email" class="form-control"  value="{{ $userData->phone2 }}"/>
                
            </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">City</label>
            <div class="input-group input-group-merge">
                <input type="text" name="city" id="multicol-email" class="form-control" value="{{ $userData->city }}"/>
            </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Pincode</label>
            <div class="input-group input-group-merge">
                <input type="text" name="pinCode" id="multicol-email" class="form-control" value="{{ $userData->pincode }}"/>
            </div>
    </div>
    <div class="col-md-4">
        @if( Auth::user()->hasRole('Admin')  )
                <label class="form-label" for="multicol-email">Branch</label>
                <select name="branch_id" class="form-control">
                        @foreach($branches as $branch)
                            
                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                        @endforeach
                </select>
            @endif
            @if( Auth::user()->hasRole('Branch-Admin')  )
                <input type="hidden" name="branch_id" class="form-control" value="{{ $branches->branch->branch_name }}" readonly/>
            @endif
    </div>
    <div class="col-md-12">
        <label class="form-label" for="multicol-email">Address</label>
            <div class="input-group input-group-merge">
                <textarea type="text" name="address" class="form-control" >{{ $userData->address }}</textarea>
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