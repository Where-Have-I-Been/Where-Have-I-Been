<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "name" => $this->country_name,
            "flag" => $this->flag_uri,
            "code" => $this->code,
        ];
    }
}
