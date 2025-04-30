<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function stock(){
        return $this->hasMany(StockProduct::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category');
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class, 'prosize_id');
    }
    

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'sale_id');
    }
}
