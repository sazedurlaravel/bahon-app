<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    // get Ward Number
    public function wardnumber()
    {
        return $this->belongsTo(WardNumber::class);
    }
      //  get admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
