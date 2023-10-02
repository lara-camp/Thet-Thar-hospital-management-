<?php


namespace App\UseCases\Department;


class DeleteDepartmentAction
{
    public function __invoke($department) : int
    {
        $department->delete();
        return 200;
    }
}
