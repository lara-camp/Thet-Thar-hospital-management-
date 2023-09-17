<?php


namespace App\UseCases\Users;

use App\Models\User;
use App\Traits\HttpResponses;

class FetchUserAction
{
    use HttpResponses;

    public function __invoke(): array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer'
        ]);
        $page = $validated['page'] ?? 1;
        $perPage = $validated['perPage'] ?? 5;
        $data = User::paginate($perPage, ['*'], 'page', $page)->withQueryString();
        $meta = $this->getPaginationMeta($data);
        return [
            'data' => $data,
            'meta' => $meta
        ];
    }
}
