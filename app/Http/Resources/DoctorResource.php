<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $uri = $request->route()->uri;
        if (!$uri) return [];

        if ($uri === 'api/dashboard/hospital/{hospitalId}/doctors') {
            return [
                'id'      => $this->id,
                'doctorInfo'    => new UserResource($this->userInfo),
                'department'  => $this->department->name ?? null,
                'experience'  => $this->experience ?? null,
                'address'  => $this->userInfo->address ?? null,
                'duty_start_time' => $this->duty_start_time ?? null,
                'duty_end_time' => $this->duty_end_time ?? null,
                'bio'  => $this->bio ?? null,
                'image' => $this->images ?? null,
                'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            ];
        }
        if ($uri === 'api/dashboard/{hospitalId}/head/assign') {
            return [
                'id'      => $this->id,
                'doctorInfo'    => new UserResource($this->userInfo),
            ];
        }
        return [
            'id'      => $this->id,
            'doctorId' => $this->user_id,
            'name'    => $this->userInfo->name ?? null,
            'email'   => $this->userInfo->email ?? null,
            'phone'    => $this->userInfo->phone ?? null,
            'department'  => $this->department->name ?? null,
            'experience'  => $this->experience ?? null,
            'address'  => $this->userInfo->address ?? null,
            'hospital' => $this->hospitals->pluck('name') ?? null,
            'duty_start_time' => $this->duty_start_time ?? null,
            'duty_end_time' => $this->duty_end_time ?? null,
            'bio'  => $this->bio ?? null,
            'image' => $this->images ?? null,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
