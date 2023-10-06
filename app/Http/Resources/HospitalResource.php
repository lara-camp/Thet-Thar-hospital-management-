<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
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

        // Only include companyName and companyStatus for /api/org
        if ($uri === 'api/user/hospital/doctors/{id}') {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'location' => $this->location,
                'bio' => $this->bio,
                'createdAt' => Carbon::parse($this->created_at)->format('Y-M-d'),
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'location' => $this->location,
            'bio' => $this->bio,
            'headmaster' => new UserResource($this->user),
            'image' => $this->image,
            'department' => $this->GetHashTagForHospital($this->id),
            'createdAt' => Carbon::parse($this->created_at)->format('Y-M-d'),
        ];
    }
}
