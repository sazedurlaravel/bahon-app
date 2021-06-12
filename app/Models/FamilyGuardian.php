<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyGuardian extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function family_members(){
        return $this->hasMany('App\Models\FamilyMember');
    }
}
