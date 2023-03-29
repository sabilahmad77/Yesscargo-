@extends('layouts.yes-cargo')
@section('title','Roles-Details')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">{{ $role->name }} Permission /</span> List</h4>
        <!-- <span class="float-end">
            <a  href="{{ url('roles/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span> -->
    </div>
    
    <div class="table-responsive text-nowrap">
       
        <table class="table table-striped border-top">
        <thead>
            <tr>
            <th>Sr#</th>
            <th>Permission</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($rolePermissions as $key => $record)
            <tr>
                <td>
                    <strong>{{ ++$key }}</strong>
                </td>
                <td>{{ $record->name }}</td>
                
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection