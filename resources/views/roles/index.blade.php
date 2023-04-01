@extends('layouts.yes-cargo')
@section('title','Roles-List')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Roles /</span> List</h4>
        <span class="float-end">
            <a  href="{{ url('roles/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
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
            <th>Sr#</th>
            <th>Role</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($roles as $key => $record)
            <tr>
                <td>
                    <strong>{{ ++$key }}</strong>
                </td>
                <td>{{ $record->name }}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('roles/'.$record->id ) }}"> <i class="ti ti-pencil me-1"></i> Show</a>
                            <a class="dropdown-item" href="{{ url('roles/'.$record->id.'/edit' ) }}"> <i class="ti ti-pencil me-1"></i> Edit</a>                                 
                            <form action="{{ url('roles/'.$record->id) }}" method="POST">
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