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
                    <td>{{ $record->starting_date }}</td>
                    <td>{{ $record->due_date }}</td>
                    <td>{{ $record->shipment_status }}</td>
                    <td>
                        <select name="shipmentStatus" class="form-control updateStatus">
                            <!-- <option value="{{ $record->shipment_status }}" selected>{{ $record->shipment_status }}</option> -->
                            <option  selected>Update Status</option>
                            <option value="Pending" >Pending</option>
                            <option value="Packed">Packed</option>
                            <option value="Loaded">Loaded</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Delivered">Delivered</option>
                        </select>
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