@extends('layouts.yes-cargo')
@section('title','Users-List')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Users /</span> List</h4>
        <span class="float-end">
            <a  href="{{ url('users/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span>
    </div>
    <div class="table-responsive text-nowrap">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <table class="table table-striped border-top" style="min-height: 175px;">
        <thead>
            <tr>
            <th>UserName</th>
            <!-- <th>ID</th> -->
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0" >
            @foreach($data as $key => $record)
            <tr>
                <td>
                    <strong>{{ $record->name }}</strong>
                </td>
                <!-- <td>
                    <strong>{{ $record->user_uid }}</strong>
                </td> -->
                <td>{{ $record->email }}</td>
                <td> {{ $record->roles->pluck('name')[0] ?? '' }} </td>
                
                <td>
                    <!-- <span class="badge {{ $record->status===1 ? 'bg-label-primary' : 'bg-label-danger'  }} me-1">{{ $record->status===1 ? 'Active' : 'Disabled'  }}</span> -->
                    <a href="{{ url('users/disable/'.$record->id ) }}" onclick="return confirm('Are you sure to change the status?')" class="badge {{ $record->status===1 ? 'bg-label-primary' : 'bg-label-danger'  }} me-1">{{ $record->status===1 ? 'Active' : 'Disabled'  }}</a>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('users/'.$record->id.'/edit' ) }}"> <i class="ti ti-pencil me-1"></i> Edit</a>                                 
                            <!-- <a class="dropdown-item" href="{{ url('users/disable/'.$record->id ) }}"> <i class="ti ti-pencil me-1"></i> Active/Disable</a> -->
                            <form action="{{ url('users/'.$record->id) }}" method="POST">
                              @method('DELETE')
                              @csrf
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete?')"> <i class="ti ti-trash me-1"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>

@endsection