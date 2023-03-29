<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'invoice_no','cosignee_name', 'cosignee_email','cosignee_phone1', 'cosignee_phone2',

        'cosignee_pincode', 'cosignee_city', 'cosignee_address',
     
        'sales_person','invoice_note','due_date', 'shipment_status',

        'sub_total','discount', 'tax','total',  'branch_admin_id', 'branch_id',

        'shipment_mode_slug','shipment_mode','customer_id','vat','discount',
        'other_charges','bill_charges', 'packing_charges', 'box_charges','starting_date'
    ];

    public function invoice_item_details(){
        return $this->hasMany(InvoiceItemDetail::class, 'invoices_id');
    }
    public function branch_admin(){

        return $this->hasOne(User::class, 'id','branch_admin_id');
    }

    public function customer(){

        return $this->hasOne(BranchClients::class, 'id','customer_id');
    }

    public function boxes(){

        return $this->hasMany(ShipmentBoxes::class, 'invoice_id','id');
    }

}
