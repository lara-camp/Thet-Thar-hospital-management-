<?php


namespace App\UseCases\Users;

use App\Models\User;
use App\Traits\HttpResponses;

class EditUserAction
{
    public function __invoke($formData, $user): User
    {
        if (request()->hasFile('image')) {
            $user->images()->delete();
        }
        $user->update($formData);
        return $user;
    }
}
