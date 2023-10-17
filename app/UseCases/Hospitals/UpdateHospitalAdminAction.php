<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class UpdateHospitalAdminAction
{
    use HttpResponses;
    public function __invoke(Hospital $hospital): int
    {
        
        $hospital->update([
            'user_id' => request()->user_id
        ]);

        return 200;
    }
}
