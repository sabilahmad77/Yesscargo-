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
    </style>
</head>
<body>
<img src="gen-img/Yes-Cargo-Logo.png" style="width: 30%; text-align:center;" alt="No logo">
<h3 style="margin-bottom:0px;margin-top:0px;margin-left:5px;text-align:center;" >Manifest Report</h3>
<table class="table1"  style="border-collapse: collapse;width: 100%;">
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
        <th>TOTAL WEIGHT</th>
        <th>{{ $totalWeight }}</th>
    </tr>
</table>

<table class="table1"  style="border-collapse: collapse;width: 100%;margin-top:5px;">
    <tr>
        <th>SNo.</th>
        <th>HWB CODE</th>
        <th>NUMBER OF BOXES</th>
        <th>RECEIVER NAME & ADDRESS</th>
        <th>DESCRIPTION OF ITEMS</th>
        <th>WEIGHT (kg)</th>
    </tr>
    @foreach($order as $key => $item )
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $item->shipment_mode_slug }}</td>
            <td style="text-align:center;">
                @php
                        $boxes = 0;
                    @endphp
                @foreach($item->invoice_item_details as $record)
                    @php $boxes += $record->boxes @endphp
                @endforeach
                {{ $boxes }}
            </td>
            <td>
                <p class="mb-0">{{ $item->cosignee_name }}</p>
                <p class="mb-0">{{ $item->cosignee_address }}</p>
            </td>
            <td>
                <ul>
                    @php
                        $totalWeight = 0;
                    @endphp
                    @foreach($item->invoice_item_details as $record)
                    <li style="list-style-type: none;">
                        {{ $record->item_name }} ({{ $record->quantity  }}),
                        <span style="display:none">{{$totalWeight += $record->weight}}</span>
                    </li>
                    @endforeach
                </ul>
            </td>
            <td style="text-align:center;">
                    {{ $totalWeight }}
            </td>
        </tr>

    @endforeach
</table>

</body>
</html>