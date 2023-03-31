@extends('layouts.yes-cargo')
@section('title','Create-Invoice')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css ') }}" />
<div class="row invoice-add">
    <!-- Invoice Add-->
    <div class="col-lg-12 col-12 mb-lg-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body px-2 py-1">
                <form class="pt-2 px-0 px-sm-2" action="{{ url('accounts/invoice') }}" method="POST">
                    @csrf
                    <input type="hidden" name="branch_id" value="{{ $branchId->id }}">
                    <input type="hidden" name="branch_name" value="{{ $branchId->branch_name }}">
                    @if ($errors->any())
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                
                    <div class="row">
                        <div class="col-lg-12">
                        <table class="table table-striped table-bordered">
                                <thead>
                                    <th colspan="3">Invoice Details:</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <label class="form-label" for="multicol-email">Invoice #</label>
                                                <div class="input-group input-group-merge">
                                                <input type="text" name="invoice_no" class="form-control"   value="{{ $lastInvoiceNo }}" id="invoiceId" readonly>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="form-label" for="multicol-email">Sales Person</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="sales_person" class="form-control" id="salesperson"  placeholder="Sales Person name">
                                            </div>
                                        </td>
                                        <td>
                                            <label class="form-label" for="multicol-email">Starting Date:</label>
                                            <div class="input-group input-group-merge">
                                                <input type="date" name="starting_date" class="form-control  w-px-150 date-picker flatpickr-input" value="{{ date('Y-m-d H:i:s') }}"  >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="form-label" for="multicol-email">Shipment Mode</label>
                                            <div class="input-group input-group-merge">
                                                <select  class="form-control shipmentMode" name="shipment_mode">

                                                    <option value="">--Select Shiment Mode--</option>
                                                    <option value="Air cargo" @selected(old('shipment_mode') == 'Air cargo')>Air cargo</option>
                                                    <option value="Budget cargo" @selected(old('shipment_mode') == 'Budget cargo')>Budget cargo</option>
                                                    <option value="Road cargo" @selected(old('shipment_mode') == 'Road cargo')>Road cargo</option>
                                                

                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <label class="form-label" for="multicol-email">Due Date</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="due_dated" id="dueDate" value="{{ old('due_dated')}}" class="form-control" placeholder="DD/MM/YYYY" readonly>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                        </table>
                        </div>
                        
                        
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-4  mb-sm-0 mb-4">
{{--                            <label class="form-label" for="multicol-email">Search</label>--}}
{{--                            <div class="input-group input-group-merge">--}}
{{--                            <input type="text" name="name"  class="form-control searchUserByName" placeholder="Search for user by name" />--}}
{{--                            </div>--}}
                            <label class="form-label" for="searchUserByName">Search</label>
                            <div class="input-group input-group-merge">
                                <select class="form-control searchable" id="searchUserByName" name="searchUserByName">
                                    <option value="">--Select Shipper--</option>
                                    @foreach(\App\Models\BranchClients::where('branches_id', $branchId->id)->get() as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-sm-0 mb-4">
                            <label class="form-label" for="multicol-email"></label>
                            <button type="button" class="btn btn-primary  searchByName">Select Shipper</button>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Shipper Details</th>
                                </thead>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Name</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="name" value="{{ old('name')}}" id="clientName" class="form-control" placeholder="Mr xyz" />
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Email</label>
                                        <div class="input-group input-group-merge">
                                            <input type="email" name="email" id="clientEmail" value="{{ old('email')}}" class="form-control" placeholder="example@example.com" />
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Phone 1</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="phone" id="phone1" value="{{ old('phone1')}}" class="form-control" placeholder="Add phone number 1" />
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Phone 2</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="phone2" id="phone2" value="{{ old('phone2')}}" class="form-control" placeholder="Add phone number 2"/>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="country">Country</label>
                                        <div class="input-group input-group-merge">
                                            <select  class="form-control searchable"  id="country" name="country">
                                                <option value="">--Select Country--</option>
                                                @foreach(\App\Models\Country::all() as $country)
                                                    <option value="{{ $country->name }}" @selected(old('country') == $country->name)>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">City</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="city" id="city" value="{{ old('city')}}" class="form-control" placeholder="Select City"/>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Pin Code</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="pincode" id="pincode" value="{{ old('pincode')}}" class="form-control" placeholder="Add Pin Code"/>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Address</label>
                                        <div class="input-group input-group-merge">
                                            <textarea type="text" name="address" id="address" value="{{ old('address')}}" class="form-control" placeholder="Add Address"></textarea>
                                        </div>
                                    </td>
                                    </tr>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th>Consignee Details:</th>
                                </thead>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Name</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="cosig_name" value="{{ old('cosig_name')}}" class="form-control" placeholder="Add Cosignee Name" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Email</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="cosig_email" value="{{ old('cosig_email')}}"  class="form-control" placeholder="Add Cosignee Email" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Phone 1</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="cosig_phone1" value="{{ old('cosig_phone1')}}"  class="form-control" placeholder="Add Phone 1" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Phone 2</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="cosig_phone2"  value="{{ old('cosig_phone2')}}" class="form-control" placeholder="Add Phone 2" />
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label class="form-label" for="cosig_country">Country</label>
                                        <div class="input-group input-group-merge">
                                            <select  class="form-control searchable"  id="cosig_country" name="cosig_country">
                                                <option value="">--Select Country--</option>
                                                @foreach(\App\Models\Country::all() as $country)
                                                    <option value="{{ $country->name }}" @selected(old('cosig_country') == $country->name)>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">City</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="cosig_city" value="{{ old('cosig_city')}}"  class="form-control" placeholder="Select City" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Pin Code</label>
                                        <div class="input-group input-group-merge">
                                            <input type="text" name="cosig_pinCode" value="{{ old('cosig_pinCode')}}" class="form-control" placeholder="Add Pin Code" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-label" for="multicol-email">Address</label>
                                        <div class="input-group input-group-merge">
                                        <textarea type="text" name="cosignee_address" value="{{ old('cosignee_address')}}" id="address" class="form-control" placeholder="Add Address"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 " style="margin-bottom:5px;" >
                            <button style="float:right;" class="btn btn-md btn-success  addboxbtn" value="{{ old('due_dated')}}"  type="button"> Add Box </button>
                        </div>
                    </div>
                    <div class="row mb-3 dynamictblId">
                        <!--<div class="col-lg-12">-->
                        <!--    <table class="table table-striped table-bordered" width="100%"  id="itemsTable">  -->
                        <!--        <input type="hidden" name="box[0][]" value="Box 1">-->
                        <!--            <tr>-->
                        <!--                <th colspan="3">Box 1</th>-->
                        <!--                <th colspan="2"> <input type="number" name="box[0][]" class="form-control" placeholder="Add Box weight"> </th>-->
                        <!--            </tr>-->
                        <!--            <tr>  -->
                        <!--                <th>Sr#</th>-->
                        <!--                <th>Item Name</th> -->
                        <!--                <th>Qty</th>  -->
                        <!--                <th>Value (SAR)</th>-->
                        <!--                <th  class="text-center" style="width:15%;">Action</th>  -->
                        <!--            </tr> -->
                        
                        <!--        <tbody id="itemsTableBody">-->
                        <!--            <tr >-->
                        <!--                <td> 1 </td>-->
                        <!--                <td> <textarea type="text" name="list[0][0][0]" cols="20" rows="1" class="form-control" ></textarea> </td>-->
                        <!--                <td> <input type="number" name="list[0][0][1]" class="form-control" ></td>-->
                        <!--                <td> <input type="number" name="list[0][0][2]" class="form-control" ></td>-->
                        <!--                <td class="text-center"> <i class="ti ti-trash me-1 text-danger remove " id="itemsTableRowRBtn" ></i></td>-->
                                        
                        <!--            </tr>-->
                        <!--        </tbody>-->
                        <!--        <tfoot> -->
                        <!--            <tr>-->
                        <!--                <td colspan="4"></td>-->
                        <!--                <td colspan="1"><button class="btn btn-md btn-primary my-2 addItembtn"   id="addBtn" type="button"> Add Item </button> </td>-->
                        <!--            </tr>-->
                        <!--        </tfoot>-->


                        <!--    </table>-->
                            
                             
                        <!--</div>-->
                    </div>
                    
                   
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="5">Other Details:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <label for="note" class="form-label fw-semibold">Box Charges</label>
                                        <input type="number" name="boxCharges" value="{{ old('boxCharges')}}" step="any" class="form-control">
                                    </td>
                                    <td>
                                        <label for="note" class="form-label fw-semibold">Packing charge</label>
                                        <input type="number" name="packingCharge" value="{{ old('packingCharge')}}" step="any" class="form-control">
                                    </td>
                                    <td>
                                        <label for="note" class="form-label fw-semibold">Bill Charges</label>
                                        <input type="number" name="bill_charge" value="{{ old('bill_charge')}}" step="any" class="form-control"  step="any">
                                    </td>
                                    <td>
                                        <label for="note" class="form-label fw-semibold">Other Charges</label>
                                        <input type="number" name="other_charges" value="{{ old('other_charges')}}" step="any" class="form-control"  step="any">
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td>
                                        <label for="note" class="form-label fw-semibold">Discount</label>
                                        <input type="number" name="discount" value="{{ old('discount')}}" step="any" class="form-control" >
                                    </td>
                                    <td>
                                        <label for="note" class="form-label fw-semibold">VAT</label>
                                        <input type="number" name="vat" value="{{ old('vat')}}" step="any" class="form-control">
                                    </td>
                                    <td colspan="2">
                                        <label for="note" class="form-label fw-semibold">Note:</label>
                                        <textarea  class="form-control"name="invoice_note" rows="1" id="note" placeholder="Invoice note">{{ old('invoice_note')}}</textarea>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            
                            
                        </div>
                        <div class="row my-3">
                            <div class="col-lg-3">
                                <button class="btn btn-md btn-primary my-2"  type="submit"> <i class="ti ti-send ti-xs me-1"></i>Create Invoice </button> 
                            </div>
                        </div>
                    </div>

                </form>
                
            </div>
            
        
        </div>
    </div>
    
    </form>



</div>
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
function deleteRow(button) {
  // Get the parent <tr> element
  const row = button.parentNode.parentNode;
  
  // Remove the <tr> element from the DOM
  row.remove();
}
    var boxTbleCounter = [];
    const addItem = (id) => {
            var dynTblSerial =  parseInt(id);
            var tableRowIndex = boxTbleCounter[dynTblSerial];
            let tableRowIndexplus = tableRowIndex + 1;
            //adding row to dynamic tbl
            var fieldHTML = '<tr ><td>'+ tableRowIndexplus +'</td><td><textarea type="text" name="list['+dynTblSerial+']['+tableRowIndex+'][0]" cols="20" rows="1" class="form-control"></textarea></td><td><input type="number" step="any" name="list['+dynTblSerial+']['+tableRowIndex+'][1]" class="form-control" ></td><td> <input type="number" step="any" name="list['+dynTblSerial+']['+tableRowIndex+'][2]" class="form-control" ></td> <td class="text-center"> <i onclick="deleteRow(this)" class="ti ti-trash me-1 text-danger" id="itemsTableRowRBtn" ></i></td></tr>'; //New input field html 
            boxTbleCounter[dynTblSerial]++; 
            $('#dynamicTblBody'+dynTblSerial).append(fieldHTML); 
            console.log(dynTblSerial);
        }
    $(document).ready(function(){

        var boxTbleLimit = 1000;
        var addboxTble = $('.addboxbtn'); //Add box
        var boxTbleWrapper = $('.dynamictblId'); //Input field wrapper
        var boxTbleWrapperRrow = $('#dynamicTblRemoveRow'); //Input field wrapper
        var boxTbleWrapperNewRow = $('#dynamicTblBody'); //Input field wrapper
        
        $(addboxTble).click(function(){
            //ADD box table
             
                var sr = boxTbleCounter.length + 1;
                var box_nu = sr - 1;
                var boxShipmentRow = '<div class="col-lg-12 my-3"><table class="table table-striped table-bordered" width="100%"  id="itemsTable"><tr><th colspan="3">Box '+sr+'</th><input type="hidden" name="box['+box_nu+'][0]" value="Box '+sr+'"> <th colspan="2"> <input type="number" step="any" name="box['+box_nu+'][1]" class="form-control" placeholder="Add Box weight"> </th></tr><tr><th>Sr#</th><th>Item Name</th><th>Qty</th> <th>Value (SAR)</th><th style="width:15%;"  class="text-center">Action</th></tr><tbody id="dynamicTblBody'+box_nu+'"><tr> <td> 1 </td> <td> <textarea type="text" name="list['+box_nu+'][0][0]" cols="20" rows="1" class="form-control"></textarea> </td> <td> <input type="number" step="any" name="list['+box_nu+'][0][1]" class="form-control" ></td> <td> <input type="number" step="any" name="list['+box_nu+'][0][2]" class="form-control" ></td> <td class="text-center"> <i onclick="deleteRow(this)" class="ti ti-trash me-1 text-danger remove" id="dynamicTblRemoveRow" ></i></td></tr></tbody><tfoot></tfoot><tr><td colspan="4"></td><td colspan="1"><button onclick="addItem('+box_nu+')" class="btn btn-md btn-primary my-2 addItembtnDynamicTbl"   id="addBtn" type="button"> Add Item </button> </td></tr></table> </div>'; //New input field html 
                boxTbleCounter.push(1); 
                $(boxTbleWrapper).append(boxShipmentRow); 
            
        });

                var sr = boxTbleCounter.length + 1;
                var box_nu = sr - 1;
                var boxShipmentRow = '<div class="col-lg-12 my-3"><table class="table table-striped table-bordered" width="100%"  id="itemsTable"><tr><th colspan="3">Box '+sr+'</th><input type="hidden" name="box['+box_nu+'][0]" value="Box 1"> <th colspan="2"> <input type="number" step="any" name="box['+box_nu+'][1]" class="form-control" placeholder="Add Box weight"> </th></tr><tr><th>Sr#</th><th>Item Name</th><th>Qty</th> <th>Value (SAR)</th><th style="width:15%;"  class="text-center">Action</th></tr><tbody id="dynamicTblBody'+box_nu+'"><tr> <td> 1 </td> <td> <textarea type="text" name="list['+box_nu+'][0][0]" cols="20" rows="1" class="form-control"></textarea> </td> <td> <input type="number" step="any" name="list['+box_nu+'][0][1]" class="form-control" ></td> <td> <input type="number" step="any" name="list['+box_nu+'][0][2]" class="form-control" ></td> <td class="text-center"> <i onclick="deleteRow(this)" class="ti ti-trash me-1 text-danger remove" id="dynamicTblRemoveRow" ></i></td></tr></tbody><tfoot></tfoot><tr><td colspan="4"></td><td colspan="1"><button onclick="addItem('+box_nu+')" class="btn btn-md btn-primary my-2 addItembtnDynamicTbl"   id="addBtn" type="button"> Add Item </button> </td></tr></table> </div>'; //New input field html 
                boxTbleCounter.push(1); 
                $(boxTbleWrapper).append(boxShipmentRow); 
        

        $(boxTbleWrapperRrow).on('click', '#dynamicTblRemoveRow', function(e){
            alert('remove dynamic tbl');
            e.preventDefault();
            $(this).closest('tr').remove(); 
            dynTblSerial--;
            
        });


        var maxField = 1000; //Input fields increment limitation
        var addButton = $('.addItembtn'); //Add item to box
        var wrapper = $('#itemsTableBody'); //Input field wrapper
        // var fieldHTML = '<tr><td><textarea type="text" name="item_name[]" cols="20" rows="2" class="form-control"></textarea></td><td><input type="number" name="item_box[]" class="form-control" ></td><td><input type="number" name="item_quantity[]" class="form-control" ></td><td><input type="number" step="any" name="item_weight[]"  min=0 class="form-control Weight"  ></td><td><input type="text" id="price" data-id="price" name="item_cost[]" class="form-control bg-light" readonly ></td><td> <i class="ti ti-trash me-1 text-danger" id="itemsTableRowRBtn" ></i></td></tr>';
        var counter = 1;
        $(addButton).click(function(){
            if(counter < maxField){ 
                var sr = counter + 1;
                var fieldHTML = '<tr><td>'+ sr+'</td><td><textarea type="text" name="list[0]['+counter+'][0]" cols="20" rows="1" class="form-control"></textarea></td><td><input type="number" step="any" name="list[0]['+counter+'][1]" class="form-control" ></td><td> <input type="number" step="any" name="list[0]['+counter+'][2]" class="form-control" ></td> <td class="text-center"> <i class="ti ti-trash me-1 text-danger" id="defaultTblRemoveRow" ></i></td></tr>'; //New input field html 
                counter++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '#defaultTblRemoveRow', function(e){
            e.preventDefault();
            $(this).closest('tr').remove(); //Remove field html
            //sr--;
            counter--; 
        });

    });
</script>

<script>
    $('.shipmentMode').on('change', function()
    {
        var value = this.value;
        $.ajax({
            type: "GET",
            url:"{{ url('accounts/invoice/shipment/due-date') }}", 
            
                data : {
                    value: value,
                },
            success: function (response) {
                $('#dueDate').val(response);
            }
        });
    
    });
</script>

<script>
    $('.searchByName').click(function (e) { 
        e.preventDefault();
        var searchUser = $('#searchUserByName').val();
        //alert(searchUser);
        $.ajax({
            type: "GET",
            url:"{{ url('branch/searchUser' ) }}",
            data : {
                searchUser: searchUser,
            },
            success: function (response) {
               // alert(response.name)
               if(response == ''){
                    alert('No Record Found! Please Add New Details!');
               }
                $('#clientName').val(response.name);
                $('#clientEmail').val(response.email);
                $('#phone1').val(response.phone1);
                $('#phone2').val(response.phone2);
                $('#pincode').val(response.pincode);
                $('#country').val(response.country);
                $('#city').val(response.city);
                $('#address').val(response.address);
            }
            // error: function(request,status,errorThrown) {
            //          alert(No record Exist);
            // }
        });
        
    });
   
</script>
<script>
$(document).ready(function () {
        $('.searchable').selectize({
            sortField: 'text'
        });
});
</script>
@endsection
@endsection