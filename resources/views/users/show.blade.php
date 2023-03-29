@extends('layouts.yes-cargo')
@section('title','My-Profile')
@section('content')
<div class="card mb-4">
    <h5 class="card-header border-bottom">Profile Details</h5>
    
    <div class="card-body ">
        
        <div class="row ">
            <div class="mb-3 col-md-6">
            <label for="firstName" class="form-label">UserName</label>
            <input class="form-control" type="text" disabled  value="{{ $user->name }}"  />
            </div>
           
            <div class="mb-3 col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input class="form-control" type="text" disabled value="{{ $user->email }}" />
            </div>
            
            <div class="mb-3 col-md-6">
            <label class="form-label" for="phoneNumber">Role</label>
            <div class="input-group input-group-merge">
                <input type="text" disabled class="form-control" value="{{ Auth::user()->roles->pluck('name')[0] ?? '' }}" />
            </div>
            </div>

            <div class="mb-3 col-md-6">
            <label class="form-label" for="phoneNumber">Account Created On</label>
            <div class="input-group input-group-merge">
                <input type="text" disabled class="form-control" value="{{ $user->created_at }}"  />
            </div>
            </div>
        </div>
        
    </div>
    <!-- /Account -->
</div>
    
@endsection