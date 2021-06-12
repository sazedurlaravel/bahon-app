<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssiginingRoomType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function CommercialholdingUser(){
        return $this->belongsTo('App\Models\CommercialHoldingUser');
    }
}
