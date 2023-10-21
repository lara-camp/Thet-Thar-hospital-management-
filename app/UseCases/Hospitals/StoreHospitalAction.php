<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;

class StoreHospitalAction
{
    public function __invoke($formData): int
    {
        $formData['user_id'] = $formData['user_id'] ?? Auth::id();
        Hospital::create($formData);

        return 201;
    }
}
