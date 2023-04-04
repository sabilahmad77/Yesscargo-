<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'invoice_no','cosignee_name', 'cosignee_email','cosignee_phone1', 'cosignee_phone2',

        'cosignee_pincode', 'cosignee_city', 'cosignee_address',
     
        'invoice_note','due_date', 'shipment_status',

        'sub_total','discount', 'tax','total',  'branch_admin_id', 'branch_id',

        'shipment_mode_slug','shipment_mode','customer_id','vat','discount',
        'other_charges','bill_charges', 'packing_charges', 'box_charges','starting_date', 'consignee_country', 'sales_person'
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
    
    public function shipmentStatuses(){

        return $this->hasMany(shipmentStatuses::class, 'invoice_id','invoice_no');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDueDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

}

