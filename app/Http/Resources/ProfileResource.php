<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        $country = $this->country;
        $photo = $this->photo;

        return [
            "name" => $this->name,
            "gender" => $this->gender,
            "description" => $this->description,
            "birth_date" => $this->when($this->birth_date !== null, $this->birth_date, null),
            "nationality" => $this->when($country !== null, new CountryResource($country), null),
            "photo" => $this->when($photo !== null, new PhotoResource($photo), null),
        ];
    }
}
