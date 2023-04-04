<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InvoiceItemDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['invoices_id', 'item_name','quantity', 
    'item_per_cost', 'price', 'weight','discount', 'boxes', 'tax', 'return_box', 'box_id'];

    public function box(){
        return $this->belongsTo(ShipmentBoxes::class, 'box_id');
    }
    // public function ShipmentboxItemList(){
    //     return $this->hasMany(InvoiceItemDetail::class, 'invoice_item_details_id', 'box_id');
    // }
}
