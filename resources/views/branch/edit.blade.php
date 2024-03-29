@extends('layouts.yes-cargo')
@section('title','Edit-Branch')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Update Details</h5>
<form action="{{ url('/branch/'.$branch->user->id) }}" method="POST"class="card-body">
    @method('PATCH')
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
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Branch Location</label>
        <input type="text" name="branch_name" id="multicol-username" class="form-control" disabled value="{{ $branch->branch_name }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Invoice Serial</label>
        <div class="input-group input-group-merge">
        <input type="text" name="invoice_serial" id="multicol-email" class="form-control" disabled value="{{ $branch->invoicing_serial }}"  aria-describedby="multicol-email2"  />
        <!-- <span class="input-group-text" id="multicol-email2">@example.com</span> -->
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">UserName</label>
            <div class="input-group input-group-merge">
                <input type="text" name="branch_user_name" id="multicol-email" class="form-control"  value="{{ $branch->user->name }}"  aria-describedby="multicol-email2" />
                <!-- <span class="input-group-text" id="multicol-email2">@example.com</span> -->
            </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Email</label>
            <div class="input-group input-group-merge">
                <input type="text" name="email" id="multicol-email" class="form-control"  value="{{ $branch->user->email }}"  aria-describedby="multicol-email2" />
                <!-- <span class="input-group-text" id="multicol-email2">@example.com</span> -->
            </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Phone</label>
            <div class="input-group input-group-merge">
                <input type="text" name="branch_user_phone" id="multicol-email" class="form-control"  value="{{ $branch->user->phone }}"  aria-describedby="multicol-email2" placeholder="Update Phone number" />
                <!-- <span class="input-group-text" id="multicol-email2">@example.com</span> -->
            </div>
    </div>
    <div class="col-md-6">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" id="multicol-password"   class="form-control" placeholder="Update Password" />
            <span class="input-group-text cursor-pointer" id="multicol-password2">
            <i class="ti ti-eye-off"></i>
            </span>
        </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-confirm-password">Confirm Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password_confirmation" id="multicol-confirm-password" class="form-control"  placeholder="Update Password"/>
            <span class="input-group-text cursor-pointer" id="multicol-confirm-password2">
            <i class="ti ti-eye-off"></i>
            </span>
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