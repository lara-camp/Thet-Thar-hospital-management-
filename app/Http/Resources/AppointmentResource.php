<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'patientName'    => $this->patient->userInfo->name,
            'doctorName'   => $this->doctor->userInfo->name,
            'department' => $this->doctor->department->name,
            'appointmentDate'    => $this->appointment_date,
            'is_visible'  => $this->is_visible,
            'description'  => $this->description,
            'status'  => $this->status,
            'type'  => $this->type,
        ];
    }
}
