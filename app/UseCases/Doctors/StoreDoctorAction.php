<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Helpers\FileHelper;

class StoreDoctorAction
{
    public function __invoke($formData): int
    {
//        $fileName = FileHelper::fileMover($formData['image']);
        $doctor = Doctor::create($formData);
//        $doctor->images()->create([
//            'url' =>  config('folderName') . '/' . $fileName, // Adjust the path as needed
//        ]);
        return 201;
    }
}
