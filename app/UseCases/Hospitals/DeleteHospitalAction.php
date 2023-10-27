<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class DeleteHospitalAction
{
    public function __invoke($hospital): int
    {
        $deleteData = Hospital::where('id', $hospital->id)->firstOrFail();
        $deleteData->update([
            'is_visible' => 0,
        ]);
        return 200;
    }
}
