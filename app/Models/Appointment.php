<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'treatments',
        'source',
        'ads_name',
        'appointment_date_time',
        'note',
    ];
    public function times()
    {
        return $this->hasMany('App\Models\Time');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function appointments()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function customerTreatment()
    {
        return $this->hasOne(CustomerTreatment::class, 'appoinment_id');
    }
}
