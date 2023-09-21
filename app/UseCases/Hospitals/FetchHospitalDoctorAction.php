<?php


namespace App\UseCases\Hospitals;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Traits\HttpResponses;

class FetchHospitalDoctorAction
{
    use HttpResponses;

    public function __invoke($id): array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer'
        ]);
        $hospital_id = $id;
        $page = $validated['page'] ?? 1;
        $perPage = $validated['perPage'] ?? 5;
        $data = Doctor::where('hospital_id', $hospital_id)->paginate($perPage, ['*'], 'page', $page)->withQueryString();
        $meta = $this->getPaginationMeta($data);
        return [
            'data' => $data,
            'meta' => $meta
        ];
    }
}
