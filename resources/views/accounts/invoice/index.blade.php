@extends('layouts.yes-cargo')
@section('title','Invoice-List')
@section('content')
    <div class="card">
        <div class="card-header pb-2">
            <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Invoice /</span> List</h4>
            @if( Auth::user()->hasRole('Branch-Admin')  )
                <span class="float-end">
            <a href="{{ url('accounts/invoice/create') }}" type="button"
               class="btn rounded-pill btn-primary waves-effect waves-light ">Create</a>
        </span>
            @endif
        </div>
    </div>
    <span style=" padding:0px 10px; 10px 10px;">
    <table id="example" class="display nowrap" style="width:100%;">
    <thead>
        <tr>
        <th>HAWB</th>
        <th>Shipper City</th>
        <th>Consignee City</th>
        <th>Starting Date</th>
        <th class="text-truncate">Due Date</th>
        <th class="text-truncate">Value (SAR)</th>
        <th>Download</th>
        <th class="cell-fit text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($InvoicesList as $record)
        <tr>
            <td>{{ $record->shipment_mode_slug }}</td>
            <td>{{ $record->customer->city }}</td>
            <td>{{ $record->cosignee_city }}</td>
            <td>{{ date('d/m/Y', strtotime($record->starting_date)) }}</td>
            <td>{{ $record->due_date }}</td>
           
            @php    
               
                $boxCharges = 0;
            @endphp

            @foreach( $record->boxes as $key => $box )
                @php 
                    $boxCharges += $box->box_charges_as_per_kg; 
                $subtotal = $boxCharges + $record->packing_charges + $record->box_charges + $record->bill_charges + $record->other_charges;
                $AfterDiscountAmount = $subtotal - $record->discount;
                $vat_value = ($record->vat / 100) * $AfterDiscountAmount;
                $netBill = $AfterDiscountAmount + $vat_value;
                @endphp

            @endforeach
            <td>
                <b> {{  @$netBill }} </b>
            </td>
            <td>
                <a href="{{ url('accounts/invoice/download/'.$record->id) }}"  class="btn btn-sm btn-primary me-1">Invoice</a>
            </td>
            <td> 
                <!-- <a class="v-btn v-btn--icon v-theme--light text-default v-btn--density-default v-btn--size-x-small v-btn--variant-text" href="{{ url('accounts/invoice/download/'.$record->id) }}"><span class="v-btn__overlay"></span><span class="v-btn__underlay"></span><span class="v-btn__content" data-no-activator=""><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light iconify iconify--tabler" style="font-size: 22px; height: 22px; width: 22px;" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="12" r="2"></circle><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14L21 3m0 0l-6.5 18a.55.55 0 0 1-1 0L10 14l-7-3.5a.55.55 0 0 1 0-1L21 3"></path></g></svg></span></a> -->
                <a href="{{ url('accounts/invoice/'.$record->id) }}"  class="btn btn-sm btn-primary me-1">Preview</a>
                <a href="{{ route('invoice.edit', $record->id) }}"
                   class="btn btn-sm btn-success me-1">Edit</a>
               
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</span>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
        
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>

@endsection
