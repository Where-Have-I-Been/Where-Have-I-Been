<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        $country = $this->country;
        return [
            "name" => $this->name,
            "birth_date" => $this->when($this->birth_date !== null, $this->birth_date, null),
            "gender" => $this->gender,
            "nationality" => $this->when($country !== null, new CountryResource($country), null),
            "description" => $this->description,
            "photo" => $this->when($this->photo !== null, new PhotoResource($this->photo), null),
        ];
    }
}
