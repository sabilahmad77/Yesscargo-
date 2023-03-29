@extends('layouts.yes-cargo')
@section('title','Clients-List')
@section('content')



<div class="card">
    <div class="card-header pb-2">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Clients /</span> List</h4>
       
        <span class="float-end">
        @if(Auth::user()->hasRole('Branch-Admin') )
            {{--<a  href="{{ url('clients/export/excel') }}" class="btn rounded-pill btn-success waves-effect waves-light ">Export Excel</a>--}}
        @endif
            <a  href="{{ url('clients/create') }}" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
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
        
            <table id="example" class="display nowrap" style="width:100%;">
        
            <thead>
            <tr>
            <th>SR#</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Phone</th>
            @if( Auth::user()->hasRole('Admin')  )
                <th>Branch</th>
            @endif
            <!-- <th>Status</th> -->
            <th>Actions</th>
            </tr>
        </thead>
            <tbody class="table-border-bottom-0">
           @foreach($branchClients as $key => $data)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->city }}</td>
                <td>{{ $data->phone1 }}</td>
                @if( Auth::user()->hasRole('Admin')  )
                    <td>{{ @$data->branch->branch_name }}</td>
                @endif
                {{--<td>
                    <a href="{{ url('branch/disable-user/'.$data->id) }}" onclick="return confirm('Are you sure to change the status?')" class="badge {{ $data->status===1 ? 'bg-label-primary' : 'bg-label-danger'  }} me-1">{{ $data->status===1 ? 'Active' : 'Disabled'  }}</a>
                </td>--}}
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('clients/'.$data->id.'/edit' ) }}"> <i class="ti ti-pencil me-1"></i> Edit</a>                                 
                            <form action="{{ url('clients/'.$data->id) }}" method="POST">
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