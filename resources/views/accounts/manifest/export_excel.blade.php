
<table>
    
    <tr>
        <th style="width: 100%;">HAWB#</th>
        <th style="width: 100%;">
        @foreach ($order as $k => $v)
            @if($loop->first)
                {{ $v->shipment_mode_slug }}-
            @endif
            @if($loop->last)
                -{{ $v->shipment_mode_slug }}
            @endif
        @endforeach
        </th>
        <th style="width: 100%;">TOTAL NO. OF PCS</th>
        <th style="width: 100%;">{{ $totalNoOfPieces }}</th>
    </tr>
    <tr>
        <th>DATE</th>
        <th>{{  date('d/m/Y', strtotime($from)) .'---'.  date('d/m/Y', strtotime($to)) }}</th>
        <th>TOTAL WEIGHT (kg)</th>
        <th>{{ $boxesTotalWeight }}</th>
    </tr>

</table>

<table>
    <thead>
    <tr>
        <th style="width: 100%;">Sr #</th>
        <th style="width: 100%;">HAWB CODE</th>
        <th style="width: 100%;">NUMBER OF BOXES</th>
        <th style="width: 100%;">Shipper Details</th>
        <th style="width: 100%;">Consignee Detail</th>
        <th style="width: 100%;">DESCRIPTION OF ITEMS</th>
        <th style="width: 100%;">WEIGHT (kg)</th>
    </tr>
    </thead>
    <tbody>
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
                <ul class="p-0">
                    
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
        <tr style="border: 1px solid black;">
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
    </tbody>
</table>
