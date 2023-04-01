@extends('layouts.yes-cargo')
@section('title','Create-Role')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Create Role</h5>
<form action="{{ url('/roles') }}" method="POST"class="card-body">
    @csrf
    <!-- <h6>1. Account Details</h6> -->
    <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Role Name</label>
        <input type="text" name="name" id="multicol-username" class="form-control" placeholder="Add Role Name" />
    </div>
    </div>
    <div class="row g-3">
    <div class="col-md-12">
        <label class="form-label" for="multicol-username">Permission</label> <br>
        @foreach($permission as $record)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="permission[]" value="{{ $record->id }}">
            <label class="form-check-label" for="inlineCheckbox2">{{ $record->name }}</label>
        </div>
        @endforeach
    </div>
    </div>
    <!-- <div class="col-md-6">
        <label class="form-label" for="multicol-email">Permission</label>
            <div class="input-group input-group-merge">
                <input type="text" name="permission" id="multicol-email" class="form-control" placeholder="Add Permissions"  aria-describedby="multicol-email2" />
            </div>
    </div> -->
    
    
    <div class="pt-4">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
</form>
</div>
@endsection