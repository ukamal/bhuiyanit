<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function products(){
        return $this->hasMany(SaleProduct::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
