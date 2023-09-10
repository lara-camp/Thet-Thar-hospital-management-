<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class DeleteHospitalAction
{
    use HttpResponses;
    public function __invoke($hospital): int
    {
        $deleteData = Hospital::where('id', $hospital->user_id)->firstOrFail();
        $deleteData->update([
            'is_visible' => false,
        ]);
        return 200;
    }
}
