@if(isset($invoice))
<div class="row g-3 ">
    <div class="col-md-12">
        <table class="table border-top bordered">
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
        <table class="table  border-top bordered">
            <thead>
                <th>SR#</th>
                <th>Action</th>
                <th>Box</th>
                <th>Weight (kg)</th>
                <th>Price  (SAR)</th>
                <th>Description Of Goods</th>
            </thead>
            <tbody>
                @foreach($invoice->boxes as $box)
                    @if($box->return_box === 1)
                        @continue;
                    @endif
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <label class="form-check-label custom-option-content" for="customCheckTemp4">
                            <input class="form-check-input" type="checkbox" value="" id="customCheckTemp4" onclick='myclicktest({{ $box->id }}, {{ $invoice->id }},{{ $invoice->branch_id }} );' >
                        </label>
                    </td>
                    <td>{{ $box->box_name }}</td>
                    <td>{{ $box->box_weight }}</td>
                    <td>{{ $box->box_charges_as_per_kg }}</td>
                    <td>
                        @foreach($box->boxes_items as $item)
                            {{ $item->item_name }}   ( {{ $item->item_per_cost }} ) <br>
                        @endforeach
                    </td>
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