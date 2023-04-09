@extends('layouts.yes-cargo')
@section('title','Add-Client')
@section('content')
<link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
          integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>
<div class="card mb-4">
<h5 class="card-header">Add New Client</h5>
<form action="{{ url('/clients') }}" method="POST"class="card-body">
    @csrf
    
    <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Client Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="multicol-username" class="form-control" value="{{ old('name')  }}" placeholder="Add Client Name"/>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Email</label>
            <div class="input-group input-group-merge">
                <input type="email" name="email" id="multicol-email" class="form-control" value="{{ old('email')  }}" placeholder="example@example.com" />
            </div>
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone 1 <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <input type="tel" name="phone1" id="multicol-email" class="form-control" value="{{ old('phone1')  }}"  placeholder="Add Phone 1"/>
            </div>
            @error('phone1')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Phone 2</label>
            <div class="input-group input-group-merge">
                <input type="text" name="phone2" id="multicol-email" class="form-control" value="{{ old('phone2')  }}"  placeholder="Add Phone 2"/>
                
            </div>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">Country  <span class="text-danger">*</span></label>
            <select class="form-control searchable" id="country" name="country">
                
                @foreach(\App\Models\Country::all() as $country)
                    <option value="{{ $country->name }}">
                           
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
            @error('country')
                <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">City</label>
            <div class="input-group input-group-merge">
                <input type="text" name="city" id="multicol-email" class="form-control" value="{{ old('city')  }}" placeholder="Add City"/>
            </div>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">Pincode</label>
            <div class="input-group input-group-merge">
                <input type="text" name="pinCode" id="multicol-email" class="form-control" value="{{ old('pinCode')  }}" placeholder="Add Pin code" />
            </div>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="multicol-email">Branch</label>
            @if( Auth::user()->hasRole('Admin')  )
                <select name="branch_id" class="form-control searchable">
                        @foreach($branches as $branch)
                        @if($loop->first)
                            
                            @endif
                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                        @endforeach
                </select>
            @endif
            @if( Auth::user()->hasRole('Branch-Admin')  )
                <input type="text" name="branch_id" class="form-control bg-light" value="{{ $user->branch->branch_name }}"   readonly/>
            @endif
    </div>
    <div class="col-md-12">
        <label class="form-label" for="multicol-email">Address</label>
            <div class="input-group input-group-merge">
                <textarea type="text" name="address" class="form-control" value="{{ old('address')  }}" placeholder="Add Address"> {{ old('address')  }}</textarea>
            </div>
    </div>

    
    </div>
    <div class="pt-4">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
</form>
</div>
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
            $('.searchable').selectize({
                sortField: 'text'
            });
        });
</script>
            @endsection
@endsection