<?php


namespace App\UseCases\Users;

use App\Models\User;
use App\Traits\HttpResponses;

class DeleteUserAction
{
    public function __invoke($user): int
    {
        $deleteData = User::where('id', $user->user_id)->firstOrFail();
        $deleteData->update([
            'is_visible' => false,
        ]);
        return 200;
    }
}
