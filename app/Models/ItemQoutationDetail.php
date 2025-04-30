<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQoutationDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function ItemQoutation()
    {
        return $this->belongsTo(ItemQoutation::class);
    }

    public function purchaseDetail()
    {
        return $this->hasOne(PurchaseDetail::class, 'prosize_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'prosize_id');
    }
}
