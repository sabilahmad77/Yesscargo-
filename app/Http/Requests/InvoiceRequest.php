<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'invoice_no' => ['nullable'],
            'cosignee_name' => ['required'],
            'sales_person' => ['required'],
            'cosignee_email' => ['nullable'],
            'cosignee_phone1' => ['nullable'],
            'cosignee_phone2' => ['nullable'],
            'cosignee_pincode' => ['nullable'],
            'consignee_country' => ['nullable'],
            'cosignee_city' => ['nullable'],
            'cosignee_address' => ['required'],
            'invoice_note' => ['nullable'],
            'due_date' => ['required'],
            'discount' => ['nullable'],
            'shipment_mode' => ['required'],
            'vat' => ['nullable'],
            'other_charges' => ['nullable'],
            'bill_charges' => ['nullable'],
            'packing_charges' => ['nullable'],
            'box_charges' => ['nullable'],
            'starting_date' => ['nullable'],

            'shipper.name' => 'required|string',
            'shipper.email' => 'nullable|email',
            'shipper.phone1' => 'required|string',
            'shipper.phone2' => 'nullable|string',
            'shipper.country' => 'nullable|string',
            'shipper.city' => 'nullable|string',
            'shipper.pincode' => 'nullable|string',
            'shipper.address' => 'nullable|string',

            'box' => ['required', 'array'],
            'box.*.box_weight' => ['required', 'integer'],
            'box.*.box_name' => ['required', 'string'],

            'box.*.items' => ['sometimes', 'array'],

            'box.*.items.*.item_name' => ['required', 'string'],
            'box.*.items.*.quantity' => ['required', 'integer'],
            'box.*.items.*.item_per_cost' => ['required', 'integer'],
        ];
    }


    public function messages()
    {
        return [
            'shipper.name.required'      => 'The shipper\'s name field is required.'
        ];
    }
}
