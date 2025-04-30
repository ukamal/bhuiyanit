<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackegeSale extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'packege_id');
    }


    public function services()
    {
        return $this->package->services ?? collect();
    }


}
