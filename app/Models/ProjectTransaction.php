<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTransaction extends Model
{
    use HasFactory;
    protected $table = 'project_transactions';
    protected $guarded = ['id'];

    public function project(){
        return $this->belongsTo(Projects::class);
    }
}
