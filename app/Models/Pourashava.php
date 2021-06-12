<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pourashava extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // get zila
    public function zila()
    {
        return $this->belongsTo(Zila::class, 'zila_id', 'id');
    }

    // get admins
    public function admins()
    {
        return $this->hasMany(Admin::class, 'pourashava_id', 'id');
    }
}
