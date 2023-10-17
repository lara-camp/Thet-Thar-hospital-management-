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
        if (!$uri) return [];

        // Only include companyName and companyStatus for /api/org
        if ($uri === 'api/normal-users') {
            $data = User::where('role', 'guest')->get();
        } else {
            $validated = request()->validate([
                'page' => 'integer',
                'perPage' => 'integer'
            ]);
            $page = $validated['page'] ?? 1;
            $perPage = $validated['perPage'] ?? 5;
            $data = User::paginate($perPage, ['*'], 'page', $page)->withQueryString();
            $meta = $this->getPaginationMeta($data);
        }

        return [
            'data' => $data,
            'meta' => $meta ?? null
        ];
    }
}
