<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_patient');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
    public function userInfo()
    {
        return $this->hasOne(User::class, 'id');
    }
}
