<?php


namespace App\UseCases\Hospitals;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;

class StoreHospitalAction
{
    public function __invoke($formData): int
    {
        $formData['user_id'] = $formData['user_id'] ?? Auth::id();
        $user = User::find($formData['user_id']);
        $user->update([
            "role" => 'hospitalAdmin'
        ]);
        Hospital::create($formData);

        return 201;
    }
}
