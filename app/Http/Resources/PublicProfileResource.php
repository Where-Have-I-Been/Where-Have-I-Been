<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublicProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "gender" => $this->gender,
            "nationality" => $this->nationality,
            "description" => $this->description,
        ];
    }
}
