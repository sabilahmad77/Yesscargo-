@extends('layouts.yes-cargo')
@section('title','Inventory-List')
@section('content')

<div class="card">
    <div class="card-header pb-2">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Inventory /</span> List</h4>
        @if( Auth::user()->hasRole('Branch-Admin')  )
        <span class="float-end">
            <!-- <a  href="{{ url('accounts/inventory/excel') }}" class="btn rounded-pill btn-success waves-effect waves-light ">Export Excel</a> -->
            <a href="{{ url('accounts/inventory/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span>
        @endif
    </div>
    
<div class="card-datatable table-responsive">
    <table id="example" class="display nowrap" style="width:100%;">
    <thead>
        <tr>
       
        <th>SR#</th>
        <th>Activity</th>
        <th class="text-truncate">Amount (SAR)</th>
        <th>Paid To</th>
        <th>Category</th>
        @if( Auth::user()->hasRole('Admin')  )
        <th>Branch</th>
        @endif
        <th>Dated</th>
        <th class="cell-fit text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invetories as $key => $invetory)
        <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $invetory->name }}</td>
        <td>{{ number_format($invetory->amount,2) }}</td>
        <td>{{ $invetory->paid_to }}</td>
        <td>{{ $invetory->category->name }}</td>
        @if( Auth::user()->hasRole('Admin')  )
            <td>{{ $invetory->branch->branch_name }}</td>
        @endif
        <td>{{ $invetory->created_at }}</td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                </button>
                <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="{{ url('accounts/inventory/'.$invetory->id.'/edit') }}"> <i class="ti ti-pencil me-1"></i> Edit</a>                                 
                    <form action="{{ url('accounts/inventory/'.$invetory->id) }}" method="POST">
                        @csrf       
                        @method('Delete')                                                      
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

@endsection
@endsection