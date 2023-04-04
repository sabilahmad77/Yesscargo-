<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
     .table1,td, th {
        border: 1px solid gray;
        text-align:left;
        padding: 5px 5px;
        /* text-decoration:capitalize; */
        }
        @page{
            margin:10px;
        }
    </style>
</head>
<body>

    <table style="width:100%;">
        <tr>
            <td style="width:40%;text-align:left;border-style:none;">
                <img src="gen-img/Yes-Cargo-Logo.png" alt=""
                     style="display:inline;padding-left:0px;margin-left:0px;" width="300">
            </td>
            <td style="width:60%;text-align:right;border-style:none;">
                <p style="font-size:12px;margin:0px;">Near Ladies Market Behind New CityFlower <br> Supermarket,
                    Seiko,Dammam,Saudi Arabia <br>
                    0138838835, 0548240456, 0573165148 <br>
                    www.yescargosaudi.in

                </p>
            </td>
        </tr>
    </table>
<table class="table1"  style="border-collapse: collapse;width: 100%;">
    <tr>
        <th>HAWB#</th>
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
        <th>DATE</th>
        <th>{{  date('d/m/Y', strtotime($from)) .'---'.  date('d/m/Y', strtotime($to)) }}</th>
        <th>TOTAL WEIGHT (kg)</th>
        <th>{{ $boxesTotalWeight }}</th>
    </tr>
</table>

<table class="table1"  style="border-collapse: collapse;width: 100%;margin-top:5px;">
        <tr>
            <th style="width: 1%;">Sr #</th>
            <th style="width: 1%;">HAWB CODE</th>
            <th style="width: 1%;">NUMBER OF BOXES</th>
            <th>Shipper Details</th>
            <th>Consignee Details</th>
            <th>DESCRIPTION OF ITEMS</th>
            <th style="width: 1%;">WEIGHT (kg)</th>
        </tr>
            @php 
                $counter = 0;
            @endphp
            @foreach($order as $key => $record)
                {{--<tr>
                    @php 
                        ++$counter;
                    @endphp
                    <td>{{ $counter }}</td>
                    <td>{{ $record->shipment_mode_slug }}</td>
                    <td>
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
                        {{ $record->customer->name }}<br>
                        {{ $record->customer->email }}<br>
                        {{ $record->customer->phone1 }}<br>
                        {{ $record->customer->phone2 }}<br>
                        {{ $record->customer->pincode }}<br>
                        {{ $record->customer->city }}<br>
                        {{ $record->customer->address }}<br>
                    </td>
                    <td>
                        {{ $record->cosignee_name }}<br>
                        {{ $record->cosignee_email }}<br>
                        {{ $record->cosignee_phone1 }}<br>
                        {{ $record->cosignee_phone2 }}<br>
                        {{ $record->cosignee_pincode }}<br>
                        {{ $record->cosignee_city }}<br>
                        {{ $record->cosignee_address }}<br>
                    </td>
                    <td>
                        <ul style="padding:0px;">
                            
                            @foreach($record->invoice_item_details as $check)
                            <li style="list-style-type: none;text-align:left;">
                                {{ $check->item_name }} ({{ $check->quantity  }}),
                                
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td >
                            {{ $shipmentBoxesWeight }}
                    </td>
                </tr>--}}
                @foreach($record->boxes as $index => $invoiceBox)
                <tr style="border: 1px solid black !important;">
                    <td>{{ ++$counter }}</td>
                    <td>{{ $record->shipment_mode_slug }}</td>
                    <td>{{ $invoiceBox->box_name}}</td>
                    <td>
                        {{ $record->customer->name }}<br>
                        {{ $record->customer->email }}<br>
                        {{ $record->customer->phone1 }}<br>
                        {{ $record->customer->phone2 }}<br>
                        {{ $record->customer->pincode }}<br>
                        {{ $record->customer->city }}<br>
                        {{ $record->customer->address }}<br>
                        
                    </td>
                    <td>
                        {{ $record->cosignee_name }}<br>
                        {{ $record->cosignee_email }}<br>
                        {{ $record->cosignee_phone1 }}<br>
                        {{ $record->cosignee_phone2 }}<br>
                        {{ $record->cosignee_pincode }}<br>
                        {{ $record->cosignee_city }}<br>
                        {{ $record->cosignee_address }}<br>
                        
                    </td>
                    <td>
                        @foreach(@$invoiceBox->boxes_items as  $invoiceBoxItem)
                            {{ $invoiceBoxItem->item_name }} ({{ $invoiceBoxItem->quantity  }})<br>
                        @endforeach
                    </td>
                    <td>
                        {{ $invoiceBox->box_weight }}
                    </td>
                </tr>
                @endforeach
            @endforeach
</table>

</body>
</html>