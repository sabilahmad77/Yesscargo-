@extends('layouts.yes-cargo')
@section('title','Add-Return Box')
@section('content')
<div class="card mb-4">
<h5 class="card-header pb-1">Add To Return Box</h5>
    
<form action="{{ url('/branch') }}" method="POST"class="card-body">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="multicol-username">Invoice No</label>
            <input type="text" name="invoice_number" id="multicol-username" class="form-control invoice_number" placeholder="Search Invoice By Invoice no" />
        </div>
        <div class="col-md-6 text-right" style="padding-top:25px;">
            <button type="submit" class="btn btn-primary me-sm-3 me-1 searchByInvoice">Submit</button>
            <button type="reset" class="btn btn-label-secondary">Cancel</button>
    
        </div>
</form>
    <div id="invoiceDetails">
        @include('cargo_master.partials.invoice_items_description')
    </div>
</div>

@section('script')

<script>
    $('.searchByInvoice').click(function (e) { 

    e.preventDefault();
    var searchInvoice = $('.invoice_number').val();

        $.ajax({
            type: "GET",
            url:"{{ url('cargo-master/invoice/search') }}", 
            
                data : {
                    searchInvoice: searchInvoice,
                },
            success: function (response) {
                //alert(response);
                if(response){
                // alert('No Record Found!')
                    $('#invoiceDetails').show();
                    $('#invoiceDetails').html(response);
                }else{
                    alert('No Record Found! Please Verify Invoice No.')
                    $('#invoiceDetails').hide();
                }
                
                //$('#dueDate').val(response);
            }
        });

    });
</script>

<script>
    function myclicktest(itemId, invoiceId,branchId)
{
    //alert(branchId);
    var itemId = itemId;
    var invoiceId = invoiceId;
    var branchId = branchId;
    $.ajax({
        type: "GET",
        url:"{{ url('cargo-master/return-box/add') }}", 
        
            data : {
                itemId: itemId,
                invoiceId: invoiceId,
                branchId: branchId,
            },
            beforeSend:function(){
                return confirm("Are you sure to add Box in Return Box?");
            },
        success: function (addedToReturnBox) {
            //alert(response);
            if(addedToReturnBox){
            // alert('No Record Found!')
                $('#invoiceDetails').show();
                $('#invoiceDetails').html(addedToReturnBox);
            }else{
                //alert('No Record Found! Please Verify Invoice No.')
                $('#invoiceDetails').hide();
            }
            
            //$('#dueDate').val(response);
        }
    });
  
}
</script>

@endsection


@endsection