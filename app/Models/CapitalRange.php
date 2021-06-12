<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapitalRange extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function business_type(){
        return $this->belongsTo(BusinessType::class, 'business_type_id', 'id');
    }
}
