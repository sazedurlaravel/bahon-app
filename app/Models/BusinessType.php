<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;
    protected $guarded = [];

     // get Ownership Type
     public function ownership_type()
     {
         return $this->belongsTo(OwnershipType::class, 'ownership_type_id', 'id');
     }

    // get Ownership Type
    public function capital_ranges()
    {
        return $this->hasMany(CapitalRange::class, 'business_type_id', 'id');
    }


}
