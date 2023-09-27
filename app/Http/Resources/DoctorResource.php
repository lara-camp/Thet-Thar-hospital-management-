<?php

namespace App\Http\Resources;

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
        return [
            'id'      => $this->id,
            'name'    => $this->userInfo->name,
            'email'   => $this->userInfo->email,
            'phone'    => $this->userInfo->phone,
            'department'  => $this->department->name,
            'experience'  => $this->experience,
            'address'  => $this->userInfo->address,
            'hospital' => $this->hospitals->pluck('name'),
            'bio'  => $this->bio,
        ];
    }
}
