<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchClients extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['branches_id', 'name','email', 'city', 'pincode', 'phone1',
    'phone2','address'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branches_id');
    }

}
