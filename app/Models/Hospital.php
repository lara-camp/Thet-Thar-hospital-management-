<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'doctor_id');
    }
}

