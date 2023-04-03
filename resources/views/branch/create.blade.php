@extends('layouts.yes-cargo')
@section('title','Add-Branch')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Add New Branch</h5>
    
<form action="{{ url('/branch') }}" method="POST"class="card-body">
    @csrf
    
    <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Branch</label>
        <input type="text" name="branch_name" id="multicol-username" class="form-control" value="{{ $branchName }}" readonly/>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Invoice Serial <span class="text-danger">*</span></label>
        <div class="input-group input-group-merge">
            <input type="number" name="invoice_serial" id="multicol-email" class="form-control" value="{{ old('invoice_serial')  }}" placeholder="Add branch serial"/>
        </div>
        @error('invoice_serial')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">UserName</label>
            <div class="input-group input-group-merge">
                <input type="text" name="userName" id="multicol-email" class="form-control" value="{{ old('userName')  }}" placeholder="Add UserName"  aria-describedby="multicol-email2" />
                
            </div>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Email <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <input type="email" name="email" id="multicol-email" class="form-control" value="{{ old('email')  }}" placeholder="example@example.com" aria-label="john.doe" aria-describedby="multicol-email2" />
            </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Phone</label>
            <div class="input-group input-group-merge">
                <input type="tel" name="phone" id="multicol-email" class="form-control" value="{{ old('phone')  }}" placeholder="Add Phone Number" aria-label="john.doe" aria-describedby="multicol-email2" />
                <!-- <span class="input-group-text" id="multicol-email2">@example.com</span> -->
            </div>
    </div>
    <div class="col-md-4">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-password">Password <span class="text-danger">*</span></label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" value="{{ old('password')  }}" id="multicol-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
            <span class="input-group-text cursor-pointer" id="multicol-password2">
            <i class="ti ti-eye-off"></i>
            </span>
        </div>
        </div>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-confirm-password">Confirm Password <span class="text-danger">*</span></label>
        <div class="input-group input-group-merge">
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation')  }}" id="multicol-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-confirm-password2" />
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