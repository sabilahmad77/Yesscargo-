@extends('layouts.yes-cargo')
@section('title','Manifest')
@section('content')

<div class="card mb-4">
    <h5 class="card-header">Create Manifest Report</h5>
    <form class="card-body" action="{{ url('accounts/manifest/create') }}" method="GET">
        @csrf
        
        <div class="row g-3">
        
        @if( Auth::user()->hasRole('Admin')  )
        <div class="col-md-3">
            <label class="form-label" for="multicol-first-name">Choose Branch</label>
            <select name="branchId" class="form-control">
                <option value="" selected>--Select Branch--</option>
                @foreach($branches as $data)
                    <option value="{{ $data->id }}">{{ $data->branch_name }}</option>
                @endforeach
            </select>
        </div>
        @else
        <input type="hidden" name="branchId" value="{{ $branches->id }}">
        @endif
        <div class="col-md-4">
            <label class="form-label" for="multicol-first-name">Start Date</label>
            <input type="date" id="multicol-first-name" class="form-control" name="start_date" >
        </div>
        <div class="col-md-4">
            <label class="form-label" for="multicol-last-name">End Date</label>
            <input type="date" id="multicol-last-name" class="form-control" name="end_date">
        </div>
        
        
       
        </div>
        <div class="pt-4">
        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
        <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
        </div>
    </form>
</div>

@endsection