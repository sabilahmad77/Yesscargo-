<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['categories_id','branch_id', 'name' , 'paid_to' , 'paid_to_email' , 'paid_to_phone1' , 'paid_to_phone2',

    'short_description', 'description','amount'
        
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function category(){
        return $this->belongsTo(Categories::class, 'categories_id');
    }
}
