<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        /**
         * $chef = User::find($this->user->id, ['id', 'name', 'photo']);
         * chef' => [
         *      'id' => $chef->id,
         *      'name' => $chef->name,
         *      'photo' => Storage::disk('images')->url($chef->photo)
         * ],
         */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'progress' => $this->progress,
            'chef' => User::query()->where('id', $this->user->id)->get()
                ->map(function ($ele) {
                    return [
                        'id' => $ele->id,
                        'name' => $ele->name,
                        'photo' => Storage::disk('images')->url($ele->photo)
                    ];
                }),
            'organisation' => (new OrganizationResource($this->organisation()->first())),
        ];
    }
}
