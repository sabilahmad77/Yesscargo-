@extends('layouts.yes-cargo')
@section('title','Invoice-Show')
@section('content')

<div class="row invoice-add">
    <!-- Invoice Add-->
    
    <div class="col-lg-12 col-12 mb-lg-0 mb-4">
        <div class="card invoice-preview-card">
        <div class="card-body p-1">
            <form class="pt-2 px-0 px-sm-2" action="{{ url('accounts/invoice') }}" method="POST">
                @csrf
                
            <!-- <hr class="my-3 mx-n4"> -->

            <div class="row p-sm-1 p-0">
                <div class="col-md-3 col-sm-12 col-12 mb-sm-0 mb-4">
                    <table class=" table table-bordered text-center table-striped">
                        <tr>
                            <td class="font-bold text-primary">DATE</td>
                        </tr>
                        <tr>
                            <th>{{ $invoice->created_at->format('d/m/Y') }}</th>
                        </tr>
                        <tr>
                            <td class="font-bold text-primary">Shipment Mode</td>
                        </tr>
                        <tr>
                            <th>{{ $invoice->shipment_mode_slug }}</th>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3 col-sm-12 col-12 mb-sm-0 mb-4">
                    <table class=" table table-bordered text-center table-striped">
                        <tr>
                            <td class="font-bold text-primary" style="font-size: 30px;font-weight: 900;">Yes Cargo</td>
                        </tr>
                        <tr>
                            <th>INVOICE / HAWB NUMBER</th>
                        </tr>
                        <tr>
                            <td class="font-bold text-primary" style="padding: 22px 0px;">{{ $invoice->invoice_no }}</td>
                        </tr>
                        
                    </table>
                </div>
                <div class="col-md-6 col-sm-12 col-12 mb-sm-0 mb-4 px-0">
                    <table class=" table table-bordered text-center table-striped" style="width:90%;">
                        <tr >
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                        </tr>
                        <tr class="d-none">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="5" style="padding: 20px 0px;">Boxes : {{ $invoice->boxes->count() }}</th>
                            <th colspan="5">Kg : {{ $boxesWeight }}</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="py-4">Bill Amount </th>
                            <th colspan="5">{{ 'SAR '.number_format($netBill, 2) }}  </th>
                        </tr>
                        
                    </table>
                </div>
                
            </div>
            

            <div class="row p-sm-1 p-0">
                <div class="col-md-12 col-sm-12 col-12 mb-sm-0 mb-4">
                    <table class=" table table-bordered text-center table-striped">
                        <tr style="text-align:left;">
                            <th class="text-primary" style="width:50%;">Shipper</td>
                            <th class="text-primary">Consignee Details</th>
                        </tr>
                        <tr style="text-align:left;">
                           <td>
                                <p class="mb-1"> {{ $invoice->customer->name }}</p>
                                <p class="mb-1"> {{ $invoice->customer->city }}</p>
                                <p class="mb-1">Pin Code: {{ $invoice->customer->pincode }}</p>
                                <p class="mb-1"> {{ $invoice->customer->phone1 }}</p>
                                
                           </td>
                           <td>
                                <p class="mb-1"> {{ $invoice->cosignee_name }}</p>
                                <p class="mb-1"> {{ $invoice->cosignee_email }}</p>
                                <p class="mb-1"> {{ $invoice->cosignee_city }}</p>
                                <p class="mb-1">{{ $invoice->cosignee_address }}</p>
                                <p class="mb-1">Pin Code: {{ $invoice->cosignee_pincode }}</p>
                                <p class="mb-1"> {{ $invoice->cosignee_phone1 }}</p>
                                <p class="mb-1"> {{ $invoice->cosignee_phone2 }}</p>
                           </td>
                        </tr>
                        
                    </table>
                </div>
            </div>

            <div class="row p-sm-1 p-0">
                @php $oddCounter = 0; $evenCounter = 0;@endphp
                @foreach($invoice->boxes as $key => $box)
                    @if ($loop->odd && $oddCounter <= 0)
                        @php $oddCounter++ ; @endphp
                    <div class="col-md-6 col-sm-12 col-6 mb-sm-0 mb-4" style="padding:0px 0px 0px 10px;">
                        <table class=" table table-bordered text-center ">
                            <thead style="background-color:red;">
                            <tr >
                                <th style="color:white;">S. N.</th>
                                <th  style="color:white;">Item Description:   السلعة وص </th>
                                <th  style="color:white;">Qty كمية</th>
                                <th  style="color:white;">Value (SAR) قيمة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->boxes as $key => $box)
                                @if ($loop->odd)
                                    <tr>
                                        <td colspan="4" style="background-color:yellow; color:black;">{{ $box->box_name  }}&nbsp; - &nbsp;{{  $box->box_weight .' kg' }}</td>
                                    
                                    </tr>
                                    @foreach($box->boxes_items as $key => $boxItem)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $boxItem->item_name }}</td>
                                            <td>{{ $boxItem->quantity }}</td>
                                            <td>{{ $boxItem->item_per_cost }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        
                                
                            </tbody>
                            
                        </table>
                    </div>
                    @endif
                    @if ($loop->even && $evenCounter <= 0)
                    @php $evenCounter++ ; @endphp
                    <div class="col-md-6 col-sm-12 col-6 mb-sm-0 mb-4" style="padding:0px 10px 0px 0px;">
                        <table class=" table table-bordered text-center ">
                            <thead style="background-color:red;">
                            <tr >
                                <th style="color:white;">S. N.</th>
                                <th  style="color:white;">Item Description:   السلعة وص </th>
                                <th  style="color:white;">Qty كمية</th>
                                <th  style="color:white;">Value (SAR) قيمة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->boxes as $key => $box)
                            @if ($loop->even)
                                    <tr>
                                        <td colspan="4" style="background-color:yellow; color:black;">{{ $box->box_name  }}&nbsp; - &nbsp;{{  $box->box_weight .' kg' }}</td>
                                    
                                    </tr>
                                    @foreach($box->boxes_items as $key => $boxItem)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $boxItem->item_name }}</td>
                                            <td>{{ $boxItem->quantity }}</td>
                                            <td>{{ $boxItem->item_per_cost }}</td>
                                        </tr>
                                    @endforeach
                            @endif
                            @endforeach
                        
                                
                            </tbody>
                            
                        </table>
                    </div>
                    @endif
                @endforeach
            </div>

            {{--<div class="row">
                <div class="col-md-12 col-sm-12 col-12 mb-sm-0 mb-4">
                        <table class=" table table-bordered text-center ">
                            <thead style="background-color:red;">
                            <tr >
                                <th style="color:white;">S. N.</th>
                                <th  style="color:white;">Item Description:   السلعة وص </th>
                                <th  style="color:white;">Qty كمية</th>
                                <th  style="color:white;">Value (SAR) قيمة</th>

                                <th style="color:white;">S. N.</th>
                                <th  style="color:white;">Item Description:   السلعة وص </th>
                                <th  style="color:white;">Qty كمية</th>
                                <th  style="color:white;">Value (SAR) قيمة</th>

                            </tr>
                            </thead>
                        </table>

                        <table class=" table table-bordered text-center " style="width:50%;">
                            <thead>
                            @foreach($invoice->boxes as $key => $box)
                                @if ($loop->odd)
                                    <tr>
                                        <td colspan="4" style="background-color:yellow; color:black;">{{ $box->box_name  }}&nbsp; - &nbsp;{{  $box->box_weight .'kg' }}</td>
                                    
                                    </tr>
                                    @foreach($box->boxes_items as $key => $boxItem)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $boxItem->item_name }}</td>
                                            <td>{{ $boxItem->quantity }}</td>
                                            <td>{{ $boxItem->item_per_cost }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </thead>
                        </table>
                         <table class=" table table-bordered text-center " style="width:50%;">
                            <thead>
                                @if ($loop->even)
                                    <tr>
                                        <td colspan="4" style="background-color:red; color:black;">{{ $box->box_name  }}&nbsp; - &nbsp;{{  $box->box_weight .'kg' }}</td>
                                    </tr>
                                        @foreach($box->boxes_items as $key => $boxItem)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $boxItem->item_name }}</td>
                                            <td>{{ $boxItem->quantity }}</td>
                                            <td>{{ $boxItem->item_per_cost }}</td>
                                        </tr>
                                    @endforeach
                                @endif

                            @endforeach
                            
                        
                </div>
            </div>--}}

            <div class="row p-sm-1 p-0">
                <div class="col-md-12 col-sm-12 col-12 mb-sm-0 mb-4 ">
                    <!-- <h5>Amount in words: {{ $amountString }}</h5>
                    <h6>Remarks: {{ $invoice->invoice_note }}</h6> -->
                    <table class="table table-bordered text-center table-striped">
                        <tbody>
                            <tr>
                                <td style="width:20%;">Amount in words:</td>
                                <td >{{ $amountString }}</td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Remarks:</td>
                                <td> {{ $invoice->invoice_note }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{--<div class="row p-sm-1 p-0">
                <div class="col-md-5 col-sm-5 col-12 mb-sm-0 mb-4">
                    <div style="border:2px solid blue; padding:5px;">
                        <h6 style="color:red;">PROHIBITED & RESTRICTED GOODS <span style="float: right;">اوِّاقيدةحظورة ِّالبضائع</span></h6>
                        <p style="float: right;">
                                ماء زمزم أو سائل أو بطاريات أو أي مادة قابلة لإلستعمال غاز ، إسمنت ، 
                                ساعة ، كاميرا ، موبايل ، البتوب ، إلخ ز جميع ِّانتجات البترولية
                                والعسكرية والشرطة الخ 
                        </p>
                        <p>
                            Zamzam water, liquid, batteries, or any flammable items 
                            Gascylinder, Cement, Watch, Camera, Mobile, Lap top
                            Etc... All Petrolium Products, Miltary & Police uniform
                            Etc....
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 col-12 mb-sm-0 mb-4">

                </div>
                <div class="col-md-5 col-sm-5 col-12 mb-sm-0 mb-4">
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-primary">Amount <span style="float: right;">لجمالي</span></th>
                                <td> {{ 'SAR '.number_format($boxShipmentCharges, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">Packing Charges <span  style="float: right;">رسوم الفاتورة</span></th>
                                <td> {{ 'SAR '.number_format($invoice->packing_charges,2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">Box Charges <span  style="float: right;">رسوم الفاتورة</span></th>
                                <td> {{ 'SAR '.number_format($invoice->box_charges,2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">Invoice Charge <span  style="float: right;">رسوم الفاتورة</span></th>
                                <td> {{ 'SAR '.number_format($invoice->bill_charges,2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">Other Charge <span style="float: right;">رسوم االخرى</span></th>
                                
                                <td> {{ 'SAR '. number_format($invoice->other_charges,2) }}  </td>
                            </tr>
                            <tr>
                                <th class="text-primary">Discount <span style="float: right;"> الخصم</span></th>
                                <td> {{ 'SAR '.number_format($invoice->discount,2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">VAT <span style="float: right;"> القيمة الضريبة ِّاضافة</span></th>
                                <td>{{ 'SAR '. number_format($vat_value,2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">Net Total <span style="float: right;">  ِّاجموع الصَّا </span></th>
                                    
                                
                                <td> {{ 'SAR '. number_format($netBill, 2) }} </td>
                            </tr>
                        </table>
                </div>
            </div>--}}

            <div class="row p-sm-1 p-0">
                <div class="col-lg-12">
                    <table class="table table-bordered text-center table-striped">
                        <tbody>
                            <tr>
                                <th class="text-primary">Amount (SAR) <span style="float: right;">لجمالي</span></th>
                                <th class="text-primary">Packing Charges (SAR) <span  style="float: right;">رسوم الفاتورة</span></th>
                                <th class="text-primary">Box Charges (SAR)  <span  style="float: right;">رسوم الفاتورة</span></th>
                                <th class="text-primary">Invoice Charge (SAR) <span  style="float: right;">رسوم الفاتورة</span></th>
                            </tr>
                            <tr>
                                <td>{{ number_format($boxShipmentCharges, 2) }}</td>
                                <td>{{ number_format($invoice->packing_charges,2) }}</td>
                                <td>{{ number_format($invoice->box_charges,2) }}</td>
                                <td> {{ number_format($invoice->bill_charges,2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-primary">Other Charge (SAR) <span style="float: right;">رسوم االخرى</span></th>
                                <th class="text-primary">Discount (SAR) <span style="float: right;"> الخصم</span></th>
                                <th class="text-primary">VAT (SAR) <span style="float: right;"> القيمة الضريبة ِّاضافة</span></th>
                                <th class="text-primary">Net Total (SAR)<span style="float: right;">  ِّاجموع الصَّا </span></th>
                            </tr>
                            <tr>
                                <td>{{ number_format($invoice->other_charges,2) }}</td>
                                <td>{{ number_format($invoice->discount,2) }}</td>
                                <td>{{  number_format($vat_value,2) }}</td>
                                <td>{{  number_format($netBill, 2) }} </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        </div>
        
    </div>
    
    </form>
    <!-- /Invoice Actions -->
</div>
@section('script')

@endsection
@endsection
