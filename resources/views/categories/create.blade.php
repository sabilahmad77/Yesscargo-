@extends('layouts.yes-cargo')
@section('title','Category-Create')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Add Category</h5>
    
<form action="{{ url('categories') }}" method="POST"class="card-body">
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
        <label class="form-label" for="multicol-username">Category</label>
        <input type="text" name="name"  class="form-control" placeholder="Add category Name" />
    </div>
    <div class="col-md-8">
        <label class="form-label" for="multicol-username">Description</label>
        <input type="text" name="description"  class="form-control" placeholder="Add category Description" />
    </div>
    
    </div>
    <div class="pt-4">
    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
    <button type="reset" class="btn btn-label-secondary">Cancel</button>
    </div>
</form>
</div>
@endsection