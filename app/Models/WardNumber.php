<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WardNumber extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    // get all village
    public function villages()
    {
        return $this->hasMany(Village::class,'wardnumber_id');
    }
      //  get admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
