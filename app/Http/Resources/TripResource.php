<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    private User $loggedUser;

    public function __construct($resource,User $user)
    {
        parent::__construct($resource);
        $this->resource = $resource;

        $this->loggedUser = $user;
    }
    public function toArray($request): array
    {
        $photo = $this->photo;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "public" => $this->published,
            "description" => $this->description,
            "user" => new UserResource($this->loggedUser),
            "likes" => $this->likers(User::class)->count(),
            "liked" => $this->loggedUser->isLiking($this->resource),
            "create_date" => $this->created_at->format("Y-m-d"),
            "update_date" => $this->updated_at->format("Y-m-d"),
            "photo" => $this->when($photo !== null, new PhotoResource($photo), null),
            "places" => PlaceResource::collection($this->whenLoaded("places")),
        ];
    }
}
