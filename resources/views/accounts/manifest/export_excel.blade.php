
<table>
    <tr>
        <th>ORIGIN</th>
        <th >Dammam</th>
        <th >FLIGHT#</th>
        <th>PACIFIC LOGISTICS SOLUTION</th>
    </tr>
    <tr>
        <th>DESTINATION</th>
        <th >DELHI</th>
        <th >DATE</th>
        <th>{{ $from .'---'. $to}}</th>
    </tr>
    <tr>
        <th >M AWB#</th>
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
        <th >TOTAL NO. OF PCS</th>
        <th>{{ $totalNoOfPieces }}</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th>TOTAL WEIGHT (kg)</th>
        <th>{{ $boxesTotalWeight }}</th>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>SN.</th>
        <th>HWB CODE</th>
        <th>No of Boxes</th>
        <th>ADDRESS</th>
        <th style="padding:5px;">DESCRIPTION OF ITEMS</th> 
        <th >WEIGHT (kg)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $key => $data)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $data->shipment_mode_slug }}</td>
            <td>
                @php
                    $shipmentBoxesWeight = 0;$boxesCounter = 0;
                @endphp
                @foreach($data->boxes as $rec)
                    @php 
                    
                        $shipmentBoxesWeight += $rec->box_weight; 
                        $boxesCounter++;
                    
                    @endphp
                @endforeach
                {{ $boxesCounter }}
            </td>
            
            <td>
                {{ $data->cosignee_name }} <br>
                {{ $data->cosignee_address }}
            </td>
            <td >
                @php $itemWeight=0   @endphp
                @foreach($data->invoice_item_details as $item)
                    {{ $item->item_name  }} ({{ $item->quantity  }})<br>
                   
                @endforeach
            </td> 
            <td>{{ $shipmentBoxesWeight }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
