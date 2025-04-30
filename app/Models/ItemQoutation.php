<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQoutation extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function products(){
        return $this->hasMany(SaleProduct::class);
    }

    public function ItemQoutationDetail()
    {
        return $this->hasMany(ItemQoutationDetail::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
