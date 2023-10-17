<?php

namespace App\UseCases\Appointments;

use App\Models\Appointment;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class FetchAppointmentAction
{
    use HttpResponses;

    public function __invoke(): array
    {
        $validated = request()->validate([
            'page' => 'integer',
            'perPage' => 'integer',
        ]);
        $perPage = $validated['perPage'] ?? 5;
        $page = $validated['page'] ?? 1;

        $user_id = Auth::id() ?? null;
        if ($user_id) {
            $data = Appointment::where('patient_id', $user_id)->paginate($perPage, ['*'], 'page',  $page)->withQueryString();
        } else {
            $data = Appointment::paginate($perPage, ['*'], 'page',  $page)->withQueryString();
        }
        $meta = $this->getPaginationMeta($data);

        $result = [
            'data' => $data,
            'meta' => $meta
        ];
        return  $result;
    }
}
