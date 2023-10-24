<?php


namespace App\UseCases\Hospitals;

use App\Models\User;
use App\Models\Hospital;
use App\Traits\HttpResponses;

class UpdateHospitalAdminAction
{
    public function __invoke(Hospital $hospital): int
    {
        $user = User::where('id', auth()->user()->id)->first(); //Change role of old admin
        $user->update([
            'role' => 'doctor'
        ]);
        $hospital->update([
            'user_id' => request()->user_id
        ]);

        $user = user::where('id', request()->user_id)->first(); //Change role of new admin
        $user->update([
            'role' => 'hospitalAdmin'
        ]);
        return 200;
    }
}
