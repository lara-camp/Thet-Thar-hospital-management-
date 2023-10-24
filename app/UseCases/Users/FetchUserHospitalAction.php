<?php


namespace App\UseCases\Users;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class FetchUserHospitalAction
{
    public function __invoke(): int|null
    {
        $hospitalId = Hospital::where('user_id', auth()->user()->id)->value('id');
        return $hospitalId;
    }
}
