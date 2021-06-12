<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zila extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    // get all pourashavas
    public function pourashavas()
    {
        return $this->hasMany(Pourashava::class, 'zila_id', 'id');
    }

    // get division
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
