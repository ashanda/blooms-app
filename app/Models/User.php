<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'nic',
        'joining_date',
        'password',
        'role_id',
        'address',
        'phone_number',
        'department',
        'image',
        'education',
        'description',
        'gender'
    ];

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
    ];

    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function time()
    {
        return $this->hasMany('App\Models\Time', 'patient_id', 'id');
    }

    public function times()
    {
        return $this->hasManyThrough('App\Models\Time', 'App\Models\Appointment', 'user_id', 'appointment_id');
    }

    public function appointment()
    {
        return $this->hasMany('App\Models\Appointment', 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
