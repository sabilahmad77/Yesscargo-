@if(isset($invoice))
<div class="row g-3 ">
    <div class="col-md-12">
        <table class="table border-top bg-light">
            <thead>
                <th>Invoice#</th>
                <th>Starting Date</th>
                <th>Due Date</th>
                <th>Shipper</th>
                <th>Consignee</th>
                <th>Consignee Address</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->shipment_mode_slug }}</td>
                    <td>{{ $invoice->starting_date }}</td>
                    <td>{{ $invoice->due_date }}</td>
                    <td>{{ $invoice->customer->name }}</td>
                    <td>{{ $invoice->cosignee_name }}</td>
                    <td>{{ $invoice->cosignee_address }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row g-3 mt-3">
    <div class="col-md-12">
        <table class="table  border-top bg-light">
            <thead>
                <th>SR#</th>
                <th>Description Of Goods</th>
                <th>Boxes</th>
                <th>PCS</th>
                <th>Weight</th>
                <th>Price</th>
                <!-- <th>Shipper</th>
                <th>Consignee</th>
                <th>Consignee Address</th> -->
               
            </thead>
            <tbody>
                @foreach($invoice->invoice_item_details as $item)
                @if($item->return_box === 1)
                        @continue
                @endif
                <tr>
                    <td>
                        <label class="form-check-label custom-option-content" for="customCheckTemp4">
                            <input class="form-check-input" type="checkbox" value="" id="customCheckTemp4" onclick='myclicktest({{ $item->id }}, {{ $invoice->id }},{{ $invoice->branch_id }} );' >
                        </label>
                    </td>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->boxes }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->weight }}</td>
                    <td>{{ $item->price }}</td>
                    <!-- <td>{{ $invoice->customer->name }}</td>
                    <td>{{ $invoice->cosignee_name }}</td>
                    <td>{{ $invoice->cosignee_address }}</td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- <div class="col-md-12">
        <button type="submit" class="btn btn-primary me-sm-3 me-1 searchByInvoice">Submit</button>
        <button type="reset" class="btn btn-label-danger">Cancel</button>
    </div> -->
</div>
@endif