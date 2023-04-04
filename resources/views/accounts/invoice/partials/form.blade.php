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
                        <input type="text" name="invoice_no" class="form-control" value="{{ isset($invoice) ? $invoice->invoice_no :  $lastInvoiceNo++ }}"
                               id="invoiceId" readonly>
                    </div>
                </td>
                <td>
                    <label class="form-label" for="multicol-email">Sales Person</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="sales_person"
                               class="form-control
                                @error('sales_person') invalid @enderror" id="salesperson"
                               value="{{ isset($invoice) ? $invoice->sales_person : old('sales_person') }}"
                               placeholder="Sales Person name">
                    </div>
                    <x-message input="sales_person"/>
                </td>
                <td>
                    <label class="form-label" for="multicol-email">Starting Date:</label>
                    <div class="input-group input-group-merge">
                        <input type="date" name="starting_date"
                               class="form-control  w-px-150 date-picker flatpickr-input"
                               value="{{ isset($invoice) ? $invoice->starting_date : date('Y-m-d') }}"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Shipment Mode</label>
                    <div class="input-group input-group-merge">
                        <select class="form-control shipmentMode  @error('shipment_mode') invalid @enderror"
                                name="shipment_mode">

                            <option value="">--Select Shipment Mode--</option>
                            <option value="Air cargo" @selected(isset($invoice) ? $invoice->shipment_mode : old('shipment_mode') == 'Air cargo')>
                                Air cargo
                            </option>
                            <option value="Budget cargo" @selected(isset($invoice) ? $invoice->shipment_mode : old('shipment_mode') == 'Budget cargo')>
                                Budget
                                cargo
                            </option>
                            <option value="Road cargo" @selected(isset($invoice) ? $invoice->shipment_mode : old('shipment_mode') == 'Road cargo')>
                                Road cargo
                            </option>
                        </select>

                    </div>
                    <x-message input="shipment_mode"/>
                </td>
                <td>
                    <label class="form-label" for="multicol-email">Due Date</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="due_date" id="dueDate"
                               value="{{ isset($invoice) ? $invoice->due_date : old('due_date') }}"
                               class="form-control @error('due_date') invalid @enderror" placeholder="DD/MM/YYYY"
                               readonly>
                    </div>
                    <x-message input="due_date"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


</div>

<div class="row my-3">
    <div class="col-sm-4  mb-sm-0 ">
        <label class="form-label" for="searchUserByName">Search</label>
        <div class="input-group input-group-merge">
            <select class="form-control searchable" id="searchUserByName" name="searchUserByName">
                <option value="">--Select Shipper--</option>
                @foreach($branchClients as $client)
                    <option value="{{ $client->name }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-2 mb-sm-0">
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
                        <input type="text" name="shipper[name]"
                               id="clientName"
                               value="{{ isset($invoice) ? $invoice->customer?->name : old('shipper.name') }}"
                               class="form-control @error('shipper.name') invalid @enderror"
                               placeholder="Mr xyz"/>
                    </div>
                    <x-message input="shipper.name"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="email" name="shipper[email]" id="clientEmail"
                               class="form-control @error('shipper.email') invalid @enderror"
                               value="{{ isset($invoice) ? $invoice->customer?->email : old('shipper.email') }}"
                               placeholder="example@example.com"/>
                    </div>
                    <x-message input="shipper.email"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Phone 1</label>
                    <div class="input-group input-group-merge">
                        <input type="number" name="shipper[phone1]" id="phone1"
                               class="form-control @error('shipper.phone1') invalid @enderror"
                               value="{{ isset($invoice) ? $invoice->customer?->phone1 : old('shipper.phone1') }}"
                               placeholder="Add phone number 1"/>
                    </div>
                    <x-message input="shipper.phone1"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Phone 2</label>
                    <div class="input-group input-group-merge">
                        <input type="number" name="shipper[phone2]" id="phone2"
                               class="form-control"
                               value="{{ isset($invoice) ? $invoice->customer?->phone2 : old('shipper.phone2') }}"
                               placeholder="Add phone number 2"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="country">Country</label>
                    <div class="input-group input-group-merge">
                        <select class="form-control searchable" id="country" name="shipper[country]">
                            <option value=""> --Select Country--</option>
                            @foreach(\App\Models\Country::all() as $country)
                                <option value="{{ $country->name }}"
                                        @selected(isset($invoice) ? $invoice->customer?->country : old('shipper.country') == $country->name)>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">City</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="shipper[city]" id="city"
                               value="{{ isset($invoice) ? $invoice->customer?->city : old('shipper.city') }}"
                               class="form-control"
                               placeholder="Select City"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Pin Code</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="shipper[pincode]" id="pincode" class="form-control"
                               value="{{ isset($invoice) ? $invoice->customer?->pincode : old('shipper.pincode') }}"
                               placeholder="Add Pin Code"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Address</label>
                    <div class="input-group input-group-merge">
                        <textarea type="text" name="shipper[address]" id="address" class="form-control"
                                  placeholder="Add Address">{{ isset($invoice) ? $invoice->customer?->address : old('shipper.address')}}</textarea>
                    </div>
                </td>
            </tr>
            </tr>
        </table>
    </div>

    <div class="col-lg-6">
        <table class="table table-striped table-bordered">
            <thead>
            <th>cosignee Details:</th>
            </thead>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Name</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="cosignee_name"
                               value="{{ isset($invoice) ? $invoice->cosignee_name : old('cosignee_name') }}"
                               class="form-control  @error('cosignee_name') invalid @enderror"
                               placeholder="Add cosignee Name"/>
                    </div>
                    <x-message input="cosignee_name"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Email</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="cosignee_email"
                               value="{{ isset($invoice) ? $invoice->cosignee_email : old('cosignee_email') }}"
                               class="form-control @error('cosignee_email') invalid @enderror"
                               placeholder="Add cosignee Email"/>
                    </div>
                    <x-message input="cosignee_email"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Phone 1</label>
                    <div class="input-group input-group-merge">
                        <input type="number" name="cosignee_phone1"
                               value="{{ isset($invoice) ? $invoice->cosignee_phone1 : old('cosignee_phone1') }}"
                               class="form-control" placeholder="Add Phone 1"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Phone 2</label>
                    <div class="input-group input-group-merge">
                        <input type="number" name="cosignee_phone2"
                               value="{{ isset($invoice) ? $invoice->cosignee_phone2 : old('cosignee_phone2') }}"
                               class="form-control" placeholder="Add Phone 2"/>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <label class="form-label" for="consignee_country">Country</label>
                    <div class="input-group input-group-merge">
                        <select class="form-control searchable" id="consignee_country" name="consignee_country">
                            <option value="">--Select Country--</option>
                            @foreach(\App\Models\Country::all() as $country)
                                <option value="{{ $country->name }}" @selected(isset($invoice) ? $invoice->consignee_country : old('consignee_country') == $country->name)>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">City</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="cosignee_city"
                               value="{{ isset($invoice) ? $invoice->cosignee_city : old('cosignee_city') }}"
                               class="form-control"
                               placeholder="Select City"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Pin Code</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="cosignee_pincode"
                               value="{{ isset($invoice) ? $invoice->cosignee_pincode : old('cosignee_pincode') }}"
                               class="form-control" placeholder="Add Pin Code"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="form-label" for="multicol-email">Address</label>
                    <div class="input-group input-group-merge">
                        <textarea type="text" name="cosignee_address" id="address" class="form-control"
                                  placeholder="Add Address">{{isset($invoice) ? $invoice->cosignee_address : old('cosignee_address') }}</textarea>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 " style="margin-bottom:5px;">
        <button style="float:right;" class="btn btn-md btn-success  addboxbtn"
                type="button"> Add Box
        </button>
    </div>
</div>

@php
    if (isset(session()->getOldInput()['box'])){
        $boxes = session()->getOldInput()['box'];
    } elseif(isset($invoice)) {
        $boxes = $invoice->boxes()->get()->toArray();
    } else {
        $boxes = [];
    }
@endphp

@if(isset(session()->getOldInput()['box']))

    @foreach(session()->getOldInput()['box'] as $key => $box)
        <div class="col-lg-12 my-3">
            <table class="table table-striped table-bordered" width="100%" id="itemsTable">
                <tr>
                    <th colspan="3">Box {{ $loop->iteration }} </th>
                    <input type="hidden" name="box[{{$key}}][box_name]" value="Box {{$loop->iteration}}">
                    <input type="hidden" name="box[{{$key}}][box_id]" value="null">
                    <th colspan="2">
                        <input type="number" step="any" name="box[{{$key}}][box_weight]"
                               class="form-control @error("box.$key.box_weight") invalid @enderror" value="{{ $box['box_weight'] }}" placeholder="Add Box weight"></th>
                </tr>
                <tr>
                    <th>Sr#</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Value (SAR)</th>
                    <th style="width:15%;" class="text-center">Action</th>
                </tr>
                <tbody id="dynamicTblBody{{$key}}">
                @foreach($box['items'] as $index => $item)
                    <tr>
                        <td> {{ $index + 1 }}</td>
                        <td>
                                                <textarea type="text"
                                                          name="box[{{$key}}][items][{{$index}}][item_name]"
                                                          cols="20"
                                                          rows="1"
                                                          class="form-control @error("box.$key.items.$index.item_name") invalid @enderror">{{$item['item_name']}}</textarea>
                        </td>
                        <td>
                            <input type="number"
                                   step="any"
                                   name="box[{{$key}}][items][{{$index}}][quantity]"
                                   value="{{$item['quantity']}}"
                                   class="form-control @error("box.$key.items.$index.quantity") invalid @enderror">
                        </td>
                        <td>
                            <input type="number"
                                   step="any"
                                   name="box[{{$key}}][items][{{$index}}][item_per_cost]"
                                   value="{{$item['item_per_cost']}}"
                                   class="form-control @error("box.$key.items.$index.item_per_cost") invalid @enderror">
                        </td>
                        <td class="text-center">
                            <i onclick="deleteRow(this)"
                               class="ti ti-trash me-1 text-danger remove"
                               id="dynamicTblRemoveRow"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="1">
                        <button onclick="addItem('{{$key}}')"
                                class="btn btn-md btn-primary my-2 addItembtnDynamicTbl"
                                type="button"> Add Item
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach

@elseif(isset($invoice))

    @foreach($invoice->boxes as $key => $box)
        <div class="col-lg-12 my-3">
            <table class="table table-striped table-bordered" width="100%" id="itemsTable">
                <tr>
                    <th colspan="3">Box {{ $loop->iteration }} </th>
                    <input type="hidden" name="box[{{$key}}][box_name]" value="Box {{$loop->iteration}}">
                    <input type="hidden" name="box[{{$key}}][box_id]" value="{{$box->id}}">
                    <th colspan="2">
                        <input type="number" step="any" name="box[{{$key}}][box_weight]"
                               class="form-control" value="{{ $box->box_weight }}" placeholder="Add Box weight"></th>
                </tr>
                <tr>
                    <th>Sr#</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>Value (SAR)</th>
                    <th style="width:15%;" class="text-center">Action</th>
                </tr>
                <tbody id="dynamicTblBody{{$key}}">
                @foreach($box->boxes_items as $index => $item)
                    <tr>
                        <td> {{ $index + 1 }}</td>
                        <td>
                            <textarea type="text"
                                      name="box[{{$key}}][items][{{$index}}][item_name]"
                                      cols="20"
                                      rows="1"
                                      class="form-control">{{$item->item_name}}</textarea>
                        </td>
                        <td>
                            <input type="number"
                                   step="any"
                                   name="box[{{$key}}][items][{{$index}}][quantity]"
                                   value="{{$item->quantity}}"
                                   class="form-control">
                        </td>
                        <td>
                            <input type="number"
                                   step="any"
                                   name="box[{{$key}}][items][{{$index}}][item_per_cost]"
                                   value="{{$item->item_per_cost}}"
                                   class="form-control">
                        </td>
                        <td class="text-center">
                            <i onclick="deleteRow(this)"
                               class="ti ti-trash me-1 text-danger remove"
                               id="dynamicTblRemoveRow"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td colspan="1">
                        <button onclick="addItem('{{$key}}')"
                                class="btn btn-md btn-primary my-2 addItembtnDynamicTbl"
                                type="button"> Add Item
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
@endif

<div class="row mb-3 dynamictblId">

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
                    <input type="number" name="box_charges"
                           value="{{ isset($invoice) ? $invoice->box_charges : old('box_charges') }}"
                           step="any"
                           class="form-control">
                </td>
                <td>
                    <label for="note" class="form-label fw-semibold">Packing charge</label>
                    <input type="number" name="packing_charge" step="any"
                           value="{{ isset($invoice) ? $invoice->packing_charge : old('packing_charge') }}"
                           class="form-control">
                </td>
                <td>
                    <label for="note" class="form-label fw-semibold">Bill Charges</label>
                    <input type="number" name="bill_charge" step="any"
                           value="{{ isset($invoice) ? $invoice->bill_charge : old('bill_charge') }}"
                           class="form-control">
                </td>
                <td>
                    <label for="note" class="form-label fw-semibold">Other Charges</label>
                    <input type="number" name="other_charges"
                           value="{{ isset($invoice) ? $invoice->other_charges : old('other_charges') }}"
                           class="form-control" step="any">
                </td>
            </tr>
            <tr>

                <td>
                    <label for="note" class="form-label fw-semibold">Discount</label>
                    <input type="number" name="discount"
                           value="{{ isset($invoice) ? $invoice->discount : old('discount') }}"
                           step="any" class="form-control">
                </td>
                <td>
                    <label for="note" class="form-label fw-semibold">VAT</label>
                    <input type="number" name="vat"
                           value="{{ isset($invoice) ? $invoice->vat : old('vat') }}" step="any" class="form-control">
                </td>
                <td colspan="2">
                    <label for="note" class="form-label fw-semibold">Note:</label>
                    <textarea class="form-control" name="invoice_note" rows="1" id="note"
                              placeholder="Invoice note">{{ isset($invoice) ? $invoice->invoice_note : old('invoice_note')}}</textarea>
                </td>
            </tr>
            </tbody>
        </table>


    </div>
    <div class="row my-3">
        <div class="col-lg-3">
            <button class="btn btn-md btn-primary my-2" type="submit"><i class="ti ti-send ti-xs me-1"></i>{{$label}}
                Invoice
            </button>
        </div>
    </div>
</div>