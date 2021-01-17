<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request): array
    {
        $photo = $this->photo;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "user" => new UserResource($this->user),
            "likes" => $this->likers(User::class)->count(),
            "create-date" => $this->created_at->format("Y-m-d"),
            "update-date" => $this->updated_at->format("Y-m-d"),
            "photo" => $this->when($photo !== null, new PhotoResource($photo), null),
            "places" => PlaceResource::collection($this->whenLoaded("places")),
        ];
    }
}
