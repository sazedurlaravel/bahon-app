<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'valid_to' => 'datetime',
        'birth_day' => 'datetime',
    ];

    // deactive scope
    public function scopeDeactive($query)
    {
        return $query->where('valid_to', '<', now());
    }

    // get pourashava
    public function pourashava()
    {
        return $this->belongsTo(Pourashava::class, 'pourashava_id', 'id');
    }

    // get vehicle type
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

    // get pourashavaAdmin
    public function pourashavaAdmin()
    {
        return $this->belongsTo(Admin::class, 'pourashava_admin_id', 'id');
    }
    
    public function businessHolderUser()
    {
        return $this->hasOne(BusinessHolderUser::class);
    }

    //get General Holder
    public function generalHoldingUser(){
        return $this->belongsTo('App\GenarelHoldingUser');
    }

    //get commercial holding user

    public function commercialHoldingUser(){
        return $this->belongsTo('App\Models\CommercialHoldingUser');
    }

     //get Village  for user

     public function village(){
        return $this->belongsTo(Village::class);
    }
    //get wordnumber  for user

    public function ward(){
        return $this->belongsTo(WardNumber::class);
    }

    public function wallets(){
        return $this->hasMany('App\Models\UserWallet');
    }

}
