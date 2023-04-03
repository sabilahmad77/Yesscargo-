@extends('layouts.yes-cargo')
@section('title','Inventory-Create')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Add Inventory</h5>
    
<form action="{{ url('accounts/inventory') }}" method="POST"class="card-body">
    @csrf
    <!-- <h6>1. Account Details</h6> -->
    
    <div class="row g-3">
    <div class="col-md-4">
        <label class="form-label" for="multicol-username">Activity Name <span class="text-danger">*</span></label>
        <input type="text" name="name"  class="form-control" placeholder="Add Activity Name"  value="{{ old('name')  }}" />
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-username">Category <span class="text-danger">*</span></label>
        <select name="cat_id" class="form-control">
            
            @foreach($categories as $cat)
                @if($loop->first)
                    <option value="">--Select Category--</option>
                @endif
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('cat_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label" for="multicol-email">Amount <span class="text-danger">*</span></label>
        <div class="input-group input-group-merge">
            <input type="number" step="any" name="amount" id="multicol-email" class="form-control"  value="{{ old('amount')  }}" placeholder="Add Amount"  />
        </div>
        @error('amount')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Paid To</label>
        <div class="input-group input-group-merge">
            <input type="text" name="paid_to" id="multicol-email" class="form-control"  value="{{ old('paid_to')  }}" placeholder="Add Reciver Name"  />
        </div>
    </div>
    
    
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone Number</label>
            <div class="input-group input-group-merge">
                <input type="text" name="paid_to_phone1"  class="form-control"  value="{{ old('paid_to_phone1')  }}" placeholder="Add phone 1"/>
            </div>
    </div>
    
   
   
    <div class="col-md-12">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-confirm-password">Description</label>
        <div class="input-group input-group-merge">
            <textarea type="text" name="description" class="form-control"  value="{{ old('description')  }}" placeholder="Add  Description">{{ old('description')  }}</textarea>
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