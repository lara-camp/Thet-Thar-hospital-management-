<?php

namespace App\UseCases\Department;

use App\Models\Department;
use App\Traits\HttpResponses;

class StoreDepartmentAction  {

    use HttpResponses;

    public function __invoke($formData) : int
    {
        $department = Department::create($formData);
        return 201;
    }
}
