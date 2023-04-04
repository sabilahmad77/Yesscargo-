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
                                    <p class="mb-0 d-block">{{ $record->customer->name }}.</p>
                                    <p class="mb-0 d-block">{{ $record->customer->city }}.</p>
                                    <p class="mb-0 d-block">{{ $record->customer->address }}.</p>
                                </td>
                                <td>
                                    <p class="mb-0 d-block">{{ $record->cosignee_name }}.</p>
                                    <p class="mb-0 d-block">{{ $record->cosignee_city }}.</p>
                                    <p class="mb-0 d-block">{{ $record->cosignee_address }}.</p>
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
                            @foreach($record->invoice_item_details as  $check)
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->shipment_mode_slug }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                            </tr>
                            @endforeach
                        @endforeach