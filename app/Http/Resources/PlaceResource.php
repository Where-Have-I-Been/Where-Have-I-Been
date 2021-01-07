<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    public function toArray($request): array
    {
        $country = $this->country;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "country" => $this->country,
            "city" => $this->city,
            "lng" => $this->lng,
            "lat" => $this->lat,
            "photos" => PhotoResource::collection($this->photos),
        ];
    }
}
