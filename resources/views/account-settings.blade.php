@extends('layouts.yes-cargo')
@section('title','Account-Settings')
@section('content')
<div class="card mb-4">
    <h5 class="card-header">Profile Details</h5>
    <!-- Account -->
    <!-- <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img src="../../assets/img/avatars/14.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
        <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
            <span class="d-none d-sm-block">Upload new photo</span>
            <i class="ti ti-upload d-block d-sm-none"></i>
            <input
                type="file"
                id="upload"
                class="account-file-input"
                hidden
                accept="image/png, image/jpeg"
            />
            </label>
            <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Reset</span>
            </button>

            <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
        </div>
        </div>
    </div>
    <hr class="my-0" /> -->
    <div class="card-body">
        <form id="formAccountSettings" action="{{ url('users/'.$user->id ) }}" method="POST">
            @method('PATCH')
            @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
            <label for="firstName" class="form-label">UserName</label>
            <input class="form-control" type="text" id="firstName" name="name" value="{{ $user->name }}"  />
            </div>
           
            <div class="mb-3 col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" />
            </div>
            
            <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Password</label>
                <input class="form-control" type="password"  name="password"   />
            </div>

            <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Confirm Password</label>
                <input class="form-control" type="password"  name="confirm-password"   />
            </div>

            <div class="mb-3 col-md-6">
            <label class="form-label" for="phoneNumber">Role</label>
            <div class="input-group input-group-merge">
                <input type="text" id="phoneNumber" name="roles" class="form-control" value="{{ Auth::user()->roles->pluck('name')[0] ?? '' }}" readonly />
            </div>
            </div>

            <div class="mb-3 col-md-6">
            <label class="form-label" for="phoneNumber">Account Created On</label>
            <div class="input-group input-group-merge">
                <input type="text" id="phoneNumber" name="role" class="form-control" value="{{ $user->created_at }}" readonly />
            </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>
        </form>
</div>
    <!-- /Account -->
    </div>
    <!-- <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
            </div>
            <form id="formAccountDeactivation" action="{{ url('users/'.$user->id) }}" method="POST">
                @method('DELETE')
                @csrf
            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
            </form>
        </div>
    </div> -->
@endsection