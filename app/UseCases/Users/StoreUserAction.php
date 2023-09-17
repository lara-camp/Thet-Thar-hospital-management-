<?php


namespace App\UseCases\Users;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Traits\HttpResponses;

class StoreUserAction
{
    use HttpResponses;
    public function __invoke($formData): int
    {
        $fileName = FileHelper::fileMover($formData['image']);
        $user = User::create($formData);
        // Create an Image model and associate it with the hospital using morphTo
        $user->images()->create([
            'url' =>  config('folderName') . '/' . $fileName, // Adjust the path as needed
        ]);
        return 201;
    }
}
