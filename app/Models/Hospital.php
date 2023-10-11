<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    public $guarded = [];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'hospital_doctor', 'hospital_id', 'doctor_id');
    }
    public function patients()
    {
        return $this->hasMany(Patient::class, 'hospital_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function GetHashTagForHospital($id)
    {
        $hospital = Hospital::find($id);
        $doctors = $hospital->doctors;
        $departmentNames = [];
        foreach ($doctors as $doctor) {
            $department = $doctor->department; // Accessing the department of an individual doctor
            if (!in_array($department->name, $departmentNames)) {
                $departmentNames[] = $department->name;
            }
        }

        return $departmentNames;
    }

    public function getDoctorsOfHospital($id)
    {
        $hospital = Hospital::find($id);
        $doctors = $hospital->doctors;

        return $doctors;
    }
}
