<?php


namespace App\UseCases\Department;
use App\Models\Department;


class UpdateDepartmentAction
{
    public function __invoke($formData , $department): Department
    {
        $department->update($formData);
        return $department;
    }
}
