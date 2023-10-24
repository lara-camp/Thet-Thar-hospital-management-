<?php

namespace App\UseCases\Department;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class FetchAllDepartmentAction
{

    public function __invoke(): Collection
    {
        $data = Department::all();
        return  $data;
    }
}
