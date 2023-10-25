<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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

        if ($uri === 'api/dashboard/hospital/{id}/doctors') {
            return [
                'id'      => $this->id,
                'name'    => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'role' => $this->role,
                'address' => $this->address,
            ];
        }

        if ($uri === 'api/dashboard/{hospitalId}/head/assign') {
            return [
                'id'      => $this->id,
                'name'    => $this->name,
            ];
        }

        if ($uri === 'api/normal-users') {
            return [
                'id'      => $this->id,
                'name'    => $this->name,
            ];
        }

        if ($uri === 'api/dashboard/hospital/{id}') {
            return [
                'id'      => $this->id,
                'name'    => $this->name,
                'email' => $this->email,
                'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d'),
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'address' => $this->address,
            'is_visible' => $this->is_visible,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
