<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request): array
    {

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "places" => PlaceResource::collection($this->places),
            "published" => $this->published,
            "draft" => $this->draft,

        ];
    }
}
