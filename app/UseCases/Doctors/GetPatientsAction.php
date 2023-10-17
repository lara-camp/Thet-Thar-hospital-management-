<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

class GetPatientsAction
{
    public function __invoke(): array
    {
        $patients = new Collection([]);
        $data = Doctor::with('patients')->where('id', auth()->user()->doctor->id)->firstOrFail()->patients;
        foreach ($data as $value) {
            $patients = $patients->add(($value->userInfo));
        }
        $result = [
            'data' => $patients,
        ];
        return  $result;
    }
}
