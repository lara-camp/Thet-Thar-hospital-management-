<?php

namespace App\Policies;

use App\Models\User;

class DepartmentPolicy
{
    public function create(User $user): bool
    {
        return $user->role === 'hospitalAdmin' || $user->role === 'superAdmin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->role === 'hospitalAdmin' || $user->role === 'superAdmin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->role === 'superAdmin';
    }
}
