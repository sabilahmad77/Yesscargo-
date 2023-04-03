@extends('layouts.yes-cargo')
@section('title','Manifest')
@section('content')

<div class="card mb-4">
    <h5 class="card-header">Generate Report</h5>
    <form class="card-body" action="{{ url('accounts/reports/show') }}" method="POST">
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
        <input type="hidden" name="branchId" value="{{ $branchId->id }}">
        @endif
        <div class="col-md-3">
            <label class="form-label" for="multicol-first-name">Report Type</label>
            <select name="reportType" class="form-control" required>
                <option value="" selected>--Select Report Type--</option>
                <option value="IncomeReport">Income Report</option>
                <option value="InventoryReport">Inventory Report</option>
                
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="multicol-first-name">Start Date</label>
            <input type="date" id="multicol-first-name" class="form-control" name="start_date" required>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="multicol-last-name">End Date</label>
            <input type="date" id="multicol-last-name" class="form-control" name="end_date" required>
        </div>
        
        </div>
        <div class="pt-4">
        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
        <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
        </div>
    </form>
</div>

@endsection