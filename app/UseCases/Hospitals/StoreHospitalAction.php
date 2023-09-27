<?php


namespace App\UseCases\Hospitals;

use App\Helpers\FileHelper;
use App\Models\Hospital;
use App\Traits\HttpResponses;

class StoreHospitalAction
{
    use HttpResponses;
    public function __invoke($formData): int
    {
//        $fileName = FileHelper::fileMover($formData['image']);
        $hospital = Hospital::create($formData);
        // Create an Image model and associate it with the hospital using morphTo
//        $hospital->images()->create([
//            'url' =>  config('folderName') . '/' . $fileName, // Adjust the path as needed
//        ]);
        return 201;
    }
}
