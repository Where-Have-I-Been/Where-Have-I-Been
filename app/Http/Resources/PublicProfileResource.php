<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "gender" => $this->gender,
            "nationality" => Country::query()->find($this->country_id)->first(),
            "description" => $this->description,
        ];
    }
}
