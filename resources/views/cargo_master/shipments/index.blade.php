@extends('layouts.yes-cargo')
@section('title','Shipments-List')
@section('content')

<div class="card">
    <div class="card-header">
        <h4 class="fw-bold d-inline"><span class="text-muted fw-light">Shipments /</span> List</h4>
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
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($InvoicesList as $record)
                <tr id="{{ $record->invoice_no  }}">
                    <td>{{ $record->shipment_mode_slug }}</td>
                    <td>{{ $record->customer->city }}</td>
                    <td>{{ $record->cosignee_city }}</td>
                    <td>{{ date('d/m/Y', strtotime($record->starting_date)) }}</td>
                    <td>{{ $record->due_date }}</td>
                    <td>{{ $record->shipment_status }}</td>
                    <td>
                        <a href="{{ url('cargo-master/shipments/update-status/'.$record->id ) }}"class="btn btn-sm btn-primary">Update</a>
                    </td>
                    {{--<td>
                        <select name="shipmentStatus" class="form-control updateStatus">
                            <!-- <option value="{{ $record->shipment_status }}" selected>{{ $record->shipment_status }}</option> -->
                            <option  selected>Update Status</option>
                            <option value="Shipment Booked" >Shipment Booked</option>
                            <option value="Ready to Load">Ready to Load </option>
                            <option value="Moving to India">Moving to India</option>
                            <option value="On the Way">On the Way</option>
                            <option value="Shipmemnt Arrived">Shipmemnt Arrived</option>

                            <option value="Waiting for Customs Clearance">Waiting for Customs Clearance</option>
                            <option value="Shipment Cleared">Shipment Cleared</option>
                            <option value="Shipment out for Delivery">Shipment out for Delivery</option>
                            <option value="Shipment Delivared">Shipment Delivared</option>
                            <option value="Custom Close">Custom Close</option>
                            <option value="Custom Delay">Custom Delay</option>
                            <option value="Reached at Port">Reached at Port</option>
                            <option value="Action Taken on Complaint">Action Taken on Complaint</option>
                            <option value="Shipment Connected">Shipment Connected</option>
                        </select>
                    </td>--}}
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

<script>
    $('.updateStatus').on('change', function() {
        var shipmentStatus = $(this).find(":selected").val();
        var invoiceId = $(this).closest('tr').attr('id'); // table row ID
        //alert(trid);
        $.ajax({
        type: "GET",
        url:"{{ url('cargo-master/shipments/update-status') }}", 
        
            data : {
                shipmentStatus: shipmentStatus,
                invoiceId : invoiceId,
            },
            beforeSend:function(){
                return confirm("Are you sure to Update Shipment Status?");
            },
        success: function (addedToReturnBox) {
            //alert(response);
            if(addedToReturnBox){
            // alert('No Record Found!')
            setTimeout(function(){window.location = window.location}); 
                $('#invoiceDetails').show();
                $('#invoiceDetails').html(addedToReturnBox);
            }else{
                //alert('No Record Found! Please Verify Invoice No.')
                $('#invoiceDetails').hide();
            }
            
            //$('#dueDate').val(response);
        }
        });
    });
</script>
@endsection
@endsection