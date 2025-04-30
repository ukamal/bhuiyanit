<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function head(){
        return $this->belongsTo(Expense::class,'expense_id');
    }
}
