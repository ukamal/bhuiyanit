<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    

    public function receivPayment()
    {
        return $this->hasOne(SaleTransaction::class, 'id', 'transaction_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    
    
}
