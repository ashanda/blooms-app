<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointment_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\User', 'patient_id', 'id');
    }
}
