@extends('layouts.yes-cargo')
@section('title','Account-Settings')
@section('content')
<div class="card mb-4">
    <h5 class="card-header">Profile Details</h5>
    
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
            <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" />
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            
            <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                    <input class="form-control" type="password" id="password" name="password"   value="{{ old('password') }}"/>
                    <span class="input-group-text cursor-pointer" >
                    <i class="ti ti-eye-off" onclick="previewPassword()"></i>
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="firstName" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                <input class="form-control" type="password" id="password2"  name="confirm-password"   value="{{ old('confirm-password') }}"/>
                <span class="input-group-text cursor-pointer" >
                    <i class="ti ti-eye-off" onclick="previewPassword2()"></i>
                    </span>
                </div>
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
    @section('script')
    <script>
      function previewPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      } 
      function previewPassword2() {
        var x = document.getElementById("password2");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      } 
    </script>
    @endsection
@endsection