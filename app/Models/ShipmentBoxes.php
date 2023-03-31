<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentBoxes extends Model
{
    use HasFactory;
    protected $table = 'shipment_boxes';
    protected $fillable = ['box_name', 'box_weight','invoice_id', 'current_shipment_rate_per_kg', 'box_charges_as_per_kg'];

    public function boxes_items(){

        return $this->hasMany(InvoiceItemDetail::class, 'box_id','id');
    }

}
