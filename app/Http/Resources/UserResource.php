<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'nom' => $this->name,
            'prenom' => $this->prenom,
            'photo' => $this->photo,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'role' => RoleResource::collection($this->roles),
        ];
    }
}
