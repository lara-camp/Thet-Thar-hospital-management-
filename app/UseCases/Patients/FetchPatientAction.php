<?php

namespace App\UseCases\Patients;


use App\Models\Patient;
use App\Traits\HttpResponses;

class FetchPatientAction{

    use HttpResponses;

    public function __invoke(): array
    {
        $validated = request()->validate([
            'page'=> 'integer',
            'perPage' => 'integer',
        ]);

        $perPage = $validated['perPage'] ?? 5;
        $page = $validated['page'] ?? 1;
        $data = Patient::paginate($perPage, ['*'], 'page', $page)->withQueryString();

        $meta = $this->getPaginationMeta($data);

        $result = [
            'data' => $data,
            'meta' => $meta
        ];

        return $result;
    }
}
