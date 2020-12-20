<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "birth_date" => $this->birth_date,
            "gender" => $this->gender,
            "nationality" => Country::query()->find($this->country_id)->first(),
            "description" => $this->description,
        ];
    }
}
