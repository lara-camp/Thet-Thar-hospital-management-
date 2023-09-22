<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'doctor_patient');
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'hospital_doctors', 'doctor_id', 'hospital_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class,  'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function userInfo()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
