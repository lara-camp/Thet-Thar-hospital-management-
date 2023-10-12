<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function userInfo()
    {
        return $this->belongsTo(User::class , "patient_id");
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
