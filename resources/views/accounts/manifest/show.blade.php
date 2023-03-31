@extends('layouts.yes-cargo')
@section('title','Show-Manifest-Report')
@section('content')

<div class="row invoice-add">
    <!-- Invoice Add-->
    <div class="col-lg-12 col-12 mb-lg-0 mb-4">
        <div class="card invoice-preview-card">
        <div class="card-body">
            
            <div class="row m-sm-1 m-0">

                <div class="col-md-6 mb-md-0 mb-4 ps-0">
                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                        <img src="{{ asset('gen-img/Yes-Cargo-Logo.png') }}" style="width: 70%;" alt="">
                    </div>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-4 " style="text-align:right;">

                    <h3 class=" mb-1 mt-3">Manifest Report</h3>
                    <form action="{{ url('accounts/download_manifest_excell') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ $from }}">
                        <input type="hidden" name="end_date" value="{{ $to }}">
                        <input type="hidden" name="branchId" value="{{ $branchId }}">
                        <button type="submit" class="btn btn-success me-sm-0 me-1 waves-effect waves-light">Export Excell</button>
                    </form>
                    <form action="{{ url('accounts/download_manifest') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="start_date" value="{{ $from }}">
                        <input type="hidden" name="end_date" value="{{ $to }}">
                        <input type="hidden" name="branchId" value="{{ $branchId }}">
                        <button type="submit" class="btn btn-primary me-sm-0 me-1 waves-effect waves-light">Export PDF</button>
                    </form>
                </div>

            </div>
            <hr class="my-3 mx-n4"> 
            <div class="row m-sm-1 m-0">

                <div class="col-md-12 mb-md-0 mb-4 ps-0">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>ORIGIN</th>
                            <th>Dammam</th>
                            <th>FLIGHT#</th>
                            <th>PACIFIC LOGISTICS SOLUTION</th>
                        </tr>
                        <tr>
                            <th>DESTINATION</th>
                            <th>DELHI</th>
                            <th>DATE</th>
                            <th>{{ $from .'---'. $to}}</th>
                        </tr>
                        <tr>
                            <th>M AWB#</th>
                            <th>
                            @foreach ($order as $k => $v)
                                @if($loop->first)
                                    {{ $v->shipment_mode_slug }}-
                                @endif
                                @if($loop->last)
                                    -{{ $v->shipment_mode_slug }}
                                @endif
                            @endforeach
                            </th>
                            <th>TOTAL NO. OF PCS</th>
                            <th>{{ $totalNoOfPieces }}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>TOTAL WEIGHT (kg)</th>
                            <th>{{ $boxesTotalWeight }}</th>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="row m-sm-1  " style="margin-top:5px;">

                <div class="col-md-12 mb-md-0 y-4 ps-0">
                    <table class="table table-bordered text-center mt-3">
                        <tr>
                            <th>SNo.</th>
                            <th>HWB CODE</th>
                            <th>NUMBER OF BOXES</th>
                            <th>RECEIVER NAME & ADDRESS</th>
                            <th>DESCRIPTION OF ITEMS</th>
                            <th>WEIGHT (kg)</th>
                        </tr>
                        @foreach($order as $key => $record)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $record->shipment_mode_slug }}</td>
                                <td style="text-align:center;">
                                    @php
                                        $shipmentBoxesWeight = 0;$boxesCounter = 0;
                                    @endphp
                                    @foreach($record->boxes as $data)
                                        @php $shipmentBoxesWeight += $data->box_weight; 
                                             $boxesCounter++;
                                        @endphp
                                    @endforeach
                                    {{ $boxesCounter }}
                                </td>
                                <td>
                                    <p class="mb-0">{{ $record->cosignee_name }}</p>
                                    <p class="mb-0">{{ $record->cosignee_address }}</p>
                                </td>
                                <td>
                                    <ul>
                                       
                                        @foreach($record->invoice_item_details as $check)
                                        <li style="list-style-type: none;">
                                            {{ $check->item_name }} ({{ $check->quantity  }}),
                                           
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td style="text-align:center;">
                                        {{ $shipmentBoxesWeight }}
                                </td>
                            </tr>
                        @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


@endsection