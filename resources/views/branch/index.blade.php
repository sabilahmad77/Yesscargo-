@extends('layouts.yes-cargo')
@section('title','Branch-List')
@section('content')

<div class="card">
    <div class="card-header pb-2">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Branch /</span> List</h4>
        @can('branch-create')
        <span class="float-end">
            <a  href="{{ url('branch/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span>
        @endcan
    </div>
    
    <div class="table-responsive text-nowrap">
        
        <table id="example" class="display nowrap" style="width:100%;">
        <thead>
            <tr>
            <th>SR#</th>
            <th>Branch</th>
            <th>Invoice Serial</th>
            <th>User</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($branches as $key => $record)
            <tr>
                <td>{{ ++$key }}</td>
                <td>
                    <strong>{{ $record->branch_name }}</strong>
                </td>
                <td>{{ $record->invoicing_serial }}</td>
                <td> {{ @$record->user->name }} </td>
                <td> {{ @$record->user->email }} </td>
                <td>
                    <a href="{{ url('branch/disable/'.$record->id) }} " onclick="return confirm('Are you sure to change the status?')" class="badge {{ $record->status===1 ? 'bg-label-primary' : 'bg-label-danger'  }} me-1">{{ $record->status===1 ? 'Active' : 'Disabled'  }}</a>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('branch/'.$record->id.'/edit' ) }}"> <i class="ti ti-pencil me-1"></i> Edit</a>                                 
                            <form action="{{ url('branch/'.$record->id) }}" method="POST">
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
@section('script')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4 ]
                }
            },
        
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>    
@endsection 
@endsection