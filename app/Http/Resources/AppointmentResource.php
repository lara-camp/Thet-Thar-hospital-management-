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
//        $uri = $request->route()->uri;
//        if(!$uri) return [];
//
//        if($uri === 'api/today-appointment'){
//            return [
//                'id'      => $this->id,
//                'patientId'    => $this->patient->userInfo->id ?? null,
//                'doctorId'    => $this->doctor_id ?? null,
//                'patientName'    => $this->patient->userInfo->name ?? null,
//                'doctorName'   => $this->doctor->userInfo->name ?? null,
//                'bookingId' => $this->booking_id ?? null,
//                'doctorLocation' => $this->doctor->hospitals->pluck('location') ?? null,
//                'appointmentTime'    => $this->appointment_time ?? null,
//                'appointmentDate'    => $this->appointment_date ?? null,
//                'is_visible'  => $this->is_visible ?? null,
//                'description'  => $this->description ?? null,
//                'status'  => $this->status ?? null,
//                'appointmentType'  => $this->appointment_type ?? null,
//            ];
//        }
        return [
            'id'      => $this->id,
            'patientId'    => $this->patient->userInfo->id ?? null,
            'doctorId'    => $this->doctor_id ?? null,
            'patientName'    => $this->patient->userInfo->name ?? null,
            'doctorName'   => $this->doctor->userInfo->name ?? null,
            'bookingId' => $this->booking_id ?? null,
            'doctorLocation' => $this->doctor->hospitals->pluck('location') ?? null,
            'appointmentTime'    => $this->appointment_time ?? null,
            'appointmentDate'    => $this->appointment_date ?? null,
            'is_visible'  => $this->is_visible ?? null,
            'description'  => $this->description ?? null,
            'status'  => $this->status ?? null,
            'appointmentType'  => $this->appointment_type ?? null,
        ];
    }
}
