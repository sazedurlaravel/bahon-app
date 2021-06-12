<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialHoldingUser extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function roomTypes(){
        return $this->hasMany('App\Models\AssigningRoomType');
    }
}
