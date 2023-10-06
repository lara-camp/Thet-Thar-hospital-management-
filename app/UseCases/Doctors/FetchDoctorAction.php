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
            'perPage' => 'integer'
        ]);
        $page = $validated['page'] ?? 1;
        $perPage = $validated['perPage'] ?? 6;

        $data = Doctor::where('is_visible', true)->paginate($perPage, ['*'], 'page',  $page)->withQueryString();
        $meta = $this->getPaginationMeta($data);

        $result = [
            'data' => $data,
            'meta' => $meta
        ];
        return  $result;
    }
}
