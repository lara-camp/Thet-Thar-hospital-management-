<?php


namespace App\UseCases\Users;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class FetchUserHospitalAction
{
    use HttpResponses;

    public function __invoke(): int
    {
        $hospitalId = Hospital::where('user_id', auth()->user()->id)->value('id');
        return $hospitalId;
    }
}
