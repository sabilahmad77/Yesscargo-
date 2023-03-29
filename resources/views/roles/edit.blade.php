@extends('layouts.yes-cargo')
@section('title','Edit-Role')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Update Role</h5>
<form action="{{ url('/roles/'.$role->id ) }}" method="POST"class="card-body">
    @method('PATCH')
    @csrf
    <!-- <h6>1. Account Details</h6> -->
    <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Role</label>
        <input type="text" name="name" id="multicol-username" class="form-control" value="{{ $role->name }}" />
    </div>
    </div>
    <div class="row g-3">
    <div class="col-md-12">
        <br>
        <label class="form-label" for="multicol-username">Permissions</label> <br> 
        @foreach($rolePermissions as $record)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="permission[]" value="{{ $record }}">
            <label class="form-check-label" for="inlineCheckbox2">{{ $record }}</label>
        </div>
        @endforeach
    </div>
    </div>
    <!-- <div class="col-md-6">
        <label class="form-label" for="multicol-email">Permission</label>
            <div class="input-group input-group-merge">
                <input type="text" name="permission" id="multicol-email" class="form-control"  />
                
            </div>
    </div> -->
   
    
    <div class="pt-4">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
</form>
</div>
@endsection