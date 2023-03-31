@extends('layouts.yes-cargo')
@section('title','Edit-Users')
@section('content')
<div class="card mb-4">
<h5 class="card-header">Update User</h5>
<form action="{{ url('/users/'.$user->id ) }}" method="POST"class="card-body">
    @method('PATCH')
    @csrf
    <!-- <h6>1. Account Details</h6> -->
    <div class="row g-3">
    <div class="col-md-6">
        <label class="form-label" for="multicol-username">Username</label>
        <input type="text" name="name" id="multicol-username" class="form-control" value="{{ $user->name }}" />
    </div>
    <div class="col-md-6">
        <label class="form-label" for="multicol-email">Email</label>
            <div class="input-group input-group-merge">
                <input type="email" name="email" id="multicol-email" class="form-control"  value="{{ $user->email }}" aria-describedby="multicol-email2" />
                <!-- <span class="input-group-text" id="multicol-email2">@example.com</span> -->
            </div>
    </div>
    <!-- <div class="col-md-12">
        <label class="form-label" for="multicol-email">Role</label>
            
            <select name="roles" id="" class="form-control" placeholder="Select Role">
                @foreach($roles as $record)
                    @if($loop->first)
                        <option >Select Role</option>
                    @endif
                    <option value="{{ $record }}">{{ $record }}</option>
                @endforeach
            </select>
    </div> -->
    <div class="col-md-6">
        <div class="form-password-toggle">
        <label class="form-label" for="multicol-password">Password</label>
        <div class="input-group input-group-merge">
            <input type="password" name="password" id="multicol-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
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
            <input type="password" name="confirm-password" id="multicol-confirm-password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-confirm-password2" />
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