<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTime extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctorAppointmentTimes()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
