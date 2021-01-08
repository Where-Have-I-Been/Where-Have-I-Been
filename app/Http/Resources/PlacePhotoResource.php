<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Photo;
use Illuminate\Http\Resources\Json\JsonResource;

class PlacePhotoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "photo_id" => $this->photo_id,
            "url" => asset(Photo::query()->where("id", $this->photo_id)->first()->path),
        ];
    }
}
