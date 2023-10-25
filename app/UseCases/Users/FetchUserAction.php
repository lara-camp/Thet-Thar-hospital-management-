<?php


namespace App\UseCases\Users;

use App\Models\User;
use App\Traits\HttpResponses;

class FetchUserAction
{
    use HttpResponses;

    public function __invoke(): array
    {
        $uri = request()->route()->uri;

        if (!$uri || $uri === 'api/normal-users') {
            return $this->getGuestUsersData();
        }

        $paginationData = $this->getPaginatedUserData();

        return [
            'data' => $paginationData['data'],
            'meta' => $paginationData['meta']
        ];
    }

    private function getGuestUsersData(): array
    {
        $guestUsers = User::where('role', 'guest')->get();

        return [
            'data' => $guestUsers,
            'meta' => null
        ];
    }

    private function getPaginatedUserData(): array
    {
        $validatedData = $this->validatePaginationRequest();
        $page = $validatedData['page'] ?? 1;
        $perPage = $validatedData['perPage'] ?? 5;

        $users = User::paginate($perPage, ['*'], 'page', $page)->withQueryString();
        $meta = $this->getPaginationMeta($users);

        return [
            'data' => $users,
            'meta' => $meta
        ];
    }

    private function validatePaginationRequest(): array
    {
        return request()->validate([
            'page' => 'integer',
            'perPage' => 'integer'
        ]);
    }
}
