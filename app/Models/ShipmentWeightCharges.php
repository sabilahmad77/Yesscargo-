<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentWeightCharges extends Model
{
    use HasFactory;
    protected $fillable = ['weight', 'price'];
}
