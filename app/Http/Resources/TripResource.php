<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request): array
    {
        $places = $this->places()->get();
        $photo = $this->photo;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "user" => new UserResource($this->user),
            "likes" => $this->likers(User::class)->count(),
            "photo" => $this->when($photo !== null, new PhotoResource($photo), null),
            "places" => $this->when($places !== null, PlaceResource::collection($places), []),
        ];
    }
}
