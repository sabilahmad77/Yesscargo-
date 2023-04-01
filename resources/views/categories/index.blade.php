@extends('layouts.yes-cargo')
@section('title','Categories-List')
@section('content')

<div class="card">
    <div class="card-header pb-2">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Categories /</span> List</h4>
        @if( Auth::user()->hasRole('Admin')  )
        <span class="float-end">
            <a href="{{ url('categories/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span>
        @endif
    </div>
    
    <span style=" padding:0px 10px; 10px 10px;">
    <table id="example" class="display nowrap" style="width:100%;">
    <thead>
        <tr>
        <th>SR#</th>
        <th>Category</th>
       <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $categries as $rec)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $rec->name }}</td>
            <td>
                <form action="{{ url('categories/'.$rec->id) }}" method="POST">
                    @csrf       
                    @method('Delete')                                                      
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')"> <i class="ti ti-trash me-1"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</span>
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
                    columns: [ 0, 1 ]
                }
            },
        
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>
@endsection
@endsection