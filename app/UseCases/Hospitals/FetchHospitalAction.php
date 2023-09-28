<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;

class FetchHospitalAction
{
    use HttpResponses;
    public function __invoke(): array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer'
        ]);
        $page = $validated['page'] ?? 1;
        $perPage = $validated['perPage'] ?? 8;
        $data = Hospital::paginate($perPage, ['*'], 'page', $page)->withQueryString();
        $meta = $this->getPaginationMeta($data);
        return [
            'data' => $data,
            'meta' => $meta
        ];
    }
}
