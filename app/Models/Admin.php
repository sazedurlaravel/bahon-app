<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

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

    // added by admin
    public function parentAdmin()
    {
        return $this->belongsTo(Admin::class, 'parent_id', 'id');
    }

    public function information()
    {
        return $this->belongsTo(Information::class);
    }


    // get ward types
    public function wardNumbers()
    {
        return $this->hasMany(WardNumber::class, 'admin_id', 'id');
    }
    // get villages types
    public function villages()
    {
        return $this->hasMany(Village::class, 'admin_id', 'id');
    }

    public function wallets(){
        return $this->hasMany('App\Models\AdminWallet');
    }
}
