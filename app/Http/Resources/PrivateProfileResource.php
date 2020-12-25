<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivateProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        $country = $this->country()->first();

        return [
            "name" => $this->name,
            "birth_date" => $this->birth_date,
            "gender" => $this->gender,
            "nationality" => $this->when($country !== null, new CountryResource($country), null),
            "description" => $this->description,
        ];
    }
}
