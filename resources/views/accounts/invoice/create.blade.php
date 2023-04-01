@extends('layouts.yes-cargo')
@section('title','Create-Invoice')
@section('content')
{{--    @dd($errors, session()->getOldInput())--}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
          integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css ') }}"/>
    <div class="row invoice-add">
        <!-- Invoice Add-->
        <div class="col-lg-12 col-12 mb-lg-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body px-2 py-1">
                    <form class="pt-2 px-0 px-sm-2" action="{{ url('accounts/invoice') }}" method="POST">
                        @csrf
                        <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                        <input type="hidden" name="branch_name" value="{{ $branch->branch_name }}">

                        @include('accounts.invoice.partials.form', ['label' => 'Create'])

                    </form>
                </div>
            </div>
        </div>

        </form>


    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
            integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script>
        function deleteRow(button) {
            // Get the parent <tr> element
            const row = button.parentNode.parentNode;

            // Remove the <tr> element from the DOM
            row.remove();
        }

        var boxTbleCounter = [];

            @foreach(Arr::get(session()->getOldInput(), 'box', []) as $bx)
                boxTbleCounter.push('{{count($bx['items'])}}');
            @endforeach

            const addItem = (id) => {
                var dynTblSerial = parseInt(id);
                var tableRowIndex = boxTbleCounter[dynTblSerial];
                let tableRowIndexplus = parseInt(tableRowIndex) + 1;
                //adding row to dynamic tbl
                var fieldHTML = '<tr ><td>' + tableRowIndexplus + '</td><td><textarea type="text" name="box[' + dynTblSerial + '][items][' + tableRowIndex + '][item_name]" cols="20" rows="1" class="form-control"></textarea></td><td><input type="number" step="any" name="box[' + dynTblSerial + '][items][' + tableRowIndex + '][quantity]" class="form-control"></td><td><input type="number" step="any" name="box[' + dynTblSerial + '][items][' + tableRowIndex + '][item_per_cost]" class="form-control"></td><td class="text-center"><i onclick="deleteRow(this)" class="ti ti-trash me-1 text-danger" id="itemsTableRowRBtn"></i></td></tr>';
                boxTbleCounter[dynTblSerial]++;
                $('#dynamicTblBody' + dynTblSerial).append(fieldHTML);
            }
            $(document).ready(function () {

                var boxTbleLimit = 1000;
                var addboxTble = $('.addboxbtn'); //Add box
                var boxTbleWrapper = $('.dynamictblId'); //Input field wrapper
                var boxTbleWrapperRrow = $('#dynamicTblRemoveRow'); //Input field wrapper
                var boxTbleWrapperNewRow = $('#dynamicTblBody'); //Input field wrapper

                $(addboxTble).click(function () {
                    //ADD box table

                    var sr = boxTbleCounter.length + 1;
                    var box_nu = sr - 1;
                    var boxShipmentRow = '<div class="col-lg-12 my-3"><table class="table table-striped table-bordered" width="100%" id="itemsTable"><tr><th colspan="3">Box ' + sr + '</th><input type="hidden" name="box[' + box_nu + '][box_name]" value="Box ' + sr + '"><th colspan="2"><input type="number" step="any" name="box[' + box_nu + '][box_weight]" class="form-control" placeholder="Add Box weight"></th></tr><tr><th>Sr#</th><th>Item Name</th><th>Qty</th><th>Value (SAR)</th><th style="width:15%;" class="text-center">Action</th></tr><tbody id="dynamicTblBody' + box_nu + '"><tr><td> 1</td><td><textarea type="text" name="box[' + box_nu + '][items][0][item_name]" cols="20" rows="1" class="form-control"></textarea></td><td><input type="number" step="any" name="box[' + box_nu + '][items][0][quantity]" class="form-control"></td><td><input type="number" step="any" name="box[' + box_nu + '][items][0][item_per_cost]" class="form-control"></td><td class="text-center"><i onclick="deleteRow(this)" class="ti ti-trash me-1 text-danger remove" id="dynamicTblRemoveRow"></i></td></tr></tbody><tfoot></tfoot><tr><td colspan="4"></td><td colspan="1"><button onclick="addItem(' + box_nu + ')" class="btn btn-md btn-primary my-2 addItembtnDynamicTbl" id="addBtn" type="button"> Add Item</button></td></tr></table></div>'
                    boxTbleCounter.push(1);
                    $(boxTbleWrapper).append(boxShipmentRow);

                });

                if(boxTbleCounter.length == 0) {
                    var sr = boxTbleCounter.length + 1;
                    var box_nu = sr - 1;
                    var boxShipmentRow = '<div class="col-lg-12 my-3"><table class="table table-striped table-bordered" width="100%" id="itemsTable"><tr><th colspan="3">Box ' + sr + '</th><input type="hidden" name="box[' + box_nu + '][box_name]" value="Box 1"><th colspan="2"><input type="number" step="any" name="box[' + box_nu + '][box_weight]" class="form-control" placeholder="Add Box weight"></th></tr><tr><th>Sr#</th><th>Item Name</th><th>Qty</th><th>Value (SAR)</th><th style="width:15%;" class="text-center">Action</th></tr><tbody id="dynamicTblBody' + box_nu + '"><tr><td> 1</td><td><textarea type="text" name="box[' + box_nu + '][items][0][item_name]" cols="20" rows="1" class="form-control"></textarea></td><td><input type="number" step="any" name="box[' + box_nu + '][items][0][quantity]" class="form-control"></td><td><input type="number" step="any" name="box[' + box_nu + '][items][0][item_per_cost]" class="form-control"></td><td class="text-center"><i onclick="deleteRow(this)" class="ti ti-trash me-1 text-danger remove" id="dynamicTblRemoveRow"></i></td></tr></tbody><tfoot></tfoot><tr><td colspan="4"></td><td colspan="1"><button onclick="addItem(' + box_nu + ')" class="btn btn-md btn-primary my-2 addItembtnDynamicTbl" id="addBtn" type="button"> Add Item</button></td></tr></table></div>';
                    boxTbleCounter.push(1);
                    $(boxTbleWrapper).append(boxShipmentRow);


                    $(boxTbleWrapperRrow).on('click', '#dynamicTblRemoveRow', function (e) {
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
                    $(addButton).click(function () {
                        if (counter < maxField) {
                            var sr = counter + 1;
                            var fieldHTML = '<tr><td>' + sr + '</td><td><textarea type="text" name="list[0][' + counter + '][0]" cols="20" rows="1" class="form-control"></textarea></td><td><input type="number" step="any" name="list[0][' + counter + '][1]" class="form-control" ></td><td> <input type="number" step="any" name="list[0][' + counter + '][2]" class="form-control" ></td> <td class="text-center"> <i class="ti ti-trash me-1 text-danger" id="defaultTblRemoveRow" ></i></td></tr>'; //New input field html
                            counter++; //Increment field counter
                            $(wrapper).append(fieldHTML); //Add field html
                        }
                    });
                    //Once remove button is clicked
                    $(wrapper).on('click', '#defaultTblRemoveRow', function (e) {
                        e.preventDefault();
                        $(this).closest('tr').remove(); //Remove field html
                        //sr--;
                        counter--;
                    });
                }
            });
    </script>

    <script>
        $('.shipmentMode').on('change', function () {
            var value = this.value;
            $.ajax({
                type: "GET",
                url: "{{ url('accounts/invoice/shipment/due-date') }}",

                data: {
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
                url: "{{ url('branch/searchUser' ) }}",
                data: {
                    searchUser: searchUser,
                },
                success: function (response) {
                    // alert(response.name)
                    if (response == '') {
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

        $(document).ready(function () {
            $('.searchable').selectize({
                sortField: 'text'
            });
        });
    </script>
@endsection