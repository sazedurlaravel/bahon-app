<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenarelHoldingUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    //get genarel Holding user guardian
    public function guardian(){
        return $this->belongsTo('App\Models\FamilyGuardian');
    }
}
