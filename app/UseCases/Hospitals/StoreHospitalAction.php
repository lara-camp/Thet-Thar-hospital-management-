<?php


namespace App\UseCases\Hospitals;

use App\Helpers\FileHelper;
use App\Models\Hospital;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class StoreHospitalAction
{
    use HttpResponses;
    public function __invoke($formData): int
    {
        $formData['user_id'] = $formData['user_id'] ?? Auth::id();
        Hospital::create($formData);

        return 201;
    }
}
