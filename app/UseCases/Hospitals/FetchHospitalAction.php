<?php


namespace App\UseCases\Hospitals;

use App\Models\Hospital;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class FetchHospitalAction
{
    use HttpResponses;

    public function __invoke(): array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer'
        ]);
        $page = $validated['page'] ?? 1;
        $perPage = $validated['perPage'] ?? 6;
        if (Auth::user()->role == 'superAdmin') {
            $data = Hospital::when(request('keyword'), function ($q) {
                $keyword = request('keyword');
                $q->where("name", "like", "%$keyword%");
            })->where("is_visible", 1)->paginate($perPage, ['*'], 'page', $page)->withQueryString();
        }
        $data = Hospital::when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->where("name", "like", "%$keyword%");
        })->where("is_visible", 1)
            ->paginate($perPage, ['*'], 'page', $page)->withQueryString();

        $meta = $this->getPaginationMeta($data);
        return [
            'data' => $data,
            'meta' => $meta
        ];
    }
}
