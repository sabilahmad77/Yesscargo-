<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnBox extends Model
{
    use HasFactory;
    protected $fillable = ['branch_id', 'invoices_id','invoice_item_details_id'];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }

    public function invoiceItem(){
        return $this->belongsTo(InvoiceItemDetail::class, 'invoice_item_details_id');
    }
    

}
