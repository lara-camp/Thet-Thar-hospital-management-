<?php

namespace App\UseCases\Doctors;

use App\Models\Doctor;
use App\Traits\HttpResponses;

class FetchDoctorAction
{
    use HttpResponses;

    public function __invoke(): array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer',
        ]);
        $perPage = $validated['perPage'] ?? 5;
        $page = $validated['page'] ?? 1;
        $data = Doctor::paginate($perPage, ['*'], 'page',  $page)->withQueryString();

        $meta = $this->getPaginationMeta($data);

        $result = [
            'data' => $data,
            'meta' => $meta
        ];
        return  $result;
    }
}
