<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnershipType extends Model
{
    use HasFactory;
    protected $guarded = [];


     // get all Business Types
     public function business_types()
     {
         return $this->hasMany(BusinessType::class, 'ownership_type_id');
     }

     //  get admin
     public function admin()
     {
         return $this->belongsTo(Admin::class);
     }
}
