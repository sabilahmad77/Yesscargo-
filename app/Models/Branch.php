<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use App\Models\User;

class Branch extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['branch_name', 'invoicing_serial','users_id'];
    
    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }
    public function Clients(){
        return $this->hasMany(BranchClients::class, 'branches_id');
    }
    public function Invoices(){
        return $this->hasMany(Invoice::class, 'branch_id');
    }
    public function inventory(){
        return $this->hasMany(Inventory::class, 'branch_id');
    }
   
}
