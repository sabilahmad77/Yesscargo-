@extends('layouts.yes-cargo')
@section('title','Invoice-List')
@section('content')

<div class="card">
    <div class="card-header pb-2">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Invoice /</span> List</h4>
        @if( Auth::user()->hasRole('Branch-Admin')  )
        <span class="float-end">
            <a href="{{ url('accounts/invoice/create') }}"type="button" class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span>
        @endif
    </div>
    
<div class="card-datatable table-responsive">
    <table id="example" class="display nowrap" style="width:100%;">
    <thead>
        <tr>
        <th>HAWB</th>
        <th>Shipper City</th>
        <th>Consignee City</th>
        <th>Starting Date</th>
        <th class="text-truncate">Due Date</th>
        <th>Generate</th>
        <th class="cell-fit text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($InvoicesList as $record)
        <tr>
            <td>{{ $record->shipment_mode_slug }}</td>
            <td>{{ $record->customer->city }}</td>
            <td>{{ $record->cosignee_city }}</td>
            <td>{{ $record->starting_date }}</td>
            <td>{{ $record->due_date }}</td>
           
            <td>
                <a href="{{ url('accounts/invoice/download/'.$record->id) }}"  class="badge bg-label-primary me-1">Invoice</a>
            </td>
            <td class="text-center"> 
                <!-- <a class="v-btn v-btn--icon v-theme--light text-default v-btn--density-default v-btn--size-x-small v-btn--variant-text" href="{{ url('accounts/invoice/download/'.$record->id) }}"><span class="v-btn__overlay"></span><span class="v-btn__underlay"></span><span class="v-btn__content" data-no-activator=""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light iconify iconify--tabler" style="font-size: 22px; height: 22px; width: 22px;" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14L21 3m0 0l-6.5 18a.55.55 0 0 1-1 0L10 14l-7-3.5a.55.55 0 0 1 0-1L21 3"></path></g></svg></span></a> -->
                <a href="{{ url('accounts/invoice/'.$record->id) }}"  class="badge bg-label-success me-1">Detail View</a>
                <!-- <a class="v-btn v-btn--icon v-theme--light text-default v-btn--density-default v-btn--size-x-small v-btn--variant-text" href="{{ url('accounts/invoice/'.$record->id) }}"><span class="v-btn__overlay"></span><span class="v-btn__underlay"></span><span class="v-btn__content" data-no-activator=""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light iconify iconify--tabler" style="font-size: 22px; height: 22px; width: 22px;" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667-6 7-10 7s-7.333-2.333-10-7c2.667-4.667 6-7 10-7s7.333 2.333 10 7"></path></g></svg></span></a> -->
                <!-- <a class="v-btn v-btn--icon v-theme--light text-default v-btn--density-default v-btn--size-x-small v-btn--variant-text" href="{{ url('accounts/invoice/'.$record->id.'/edit') }}"><span class="v-btn__overlay"></span><span class="v-btn__underlay"></span><span class="v-btn__content" data-no-activator=""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light iconify iconify--tabler" style="font-size: 22px; height: 22px; width: 22px;" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415zM16 5l3 3"></path></g></svg></span></a> -->
                <!-- href="url('accounts/invoice/'.$record->id.'/edit')" -->

                
                <!-- <form action="{{ url('accounts/invoice/'.$record->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete?')"> <i class="ti ti-trash me-1"></i></button>
                    </form> -->
                <!-- <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('accounts/invoice/'.$record->id.'/edit' ) }}"> <i class="ti ti-pencil me-1"></i> Edit</a>                                 
                        <form action="{{ url('accounts/invoice/'.$record->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure to delete?')"> <i class="ti ti-trash me-1"></i> Delete</button>
                        </form>
                    </div>
                </div> -->
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
@section('script')
<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/moment/moment.js ') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js ') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js ') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js ') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js ') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js ') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js ') }}"></script>

<!-- Main JS -->
<!-- <script src="{{ asset('assets/js/main.js ') }}"></script> -->

<!-- Page JS -->
<script src="{{ asset('assets/js/app-invoice-list.js ') }}"></script>
@endsection
@endsection