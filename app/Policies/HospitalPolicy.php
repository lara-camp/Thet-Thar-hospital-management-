<?php

namespace App\Policies;

use App\Models\Hospital;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HospitalPolicy
{
    public function before(User $user)
    {
        if($user->role === "superAdmin"){
            return true;
        }
        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hospital $hospital): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'hospitalAdmin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hospital $hospital): bool
    {
        if ($user->role === 'hospitalAdmin' && $user->id === $hospital->user_id){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hospital $hospital): bool
    {
        if ($user->role === 'hospitalAdmin' && $user->id === $hospital->user_id){
            return true;
        }
        return false;
    }

}
