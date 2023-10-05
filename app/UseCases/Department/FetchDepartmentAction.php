<?php

namespace App\UseCases\Department;

use App\Models\Department;
use App\Traits\HttpResponses;

class FetchDepartmentAction
{
    use HttpResponses;

    public function __invoke():array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer'
        ]);
        $page = $validated['page'] ?? 1;
        $perPage = $validated['perPage'] ?? 5;
        $data = Department::paginate($perPage, ['*'], 'page',  $page)->withQueryString();
        $meta = $this->getPaginationMeta($data);

        $result = [
            'data' => $data,
            'meta' => $meta
        ];
        return  $result;
    }
}
