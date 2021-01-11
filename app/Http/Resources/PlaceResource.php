<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    public function toArray($request): array
    {
        $photos = $this->placePhotos()->get();

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "country" => $this->country,
            "city" => $this->city,
            "lng" => $this->lng,
            "lat" => $this->lat,
            "photos" => $this->when($photos !== null, PlacePhotoResource::collection($photos), []),
        ];
    }
}
