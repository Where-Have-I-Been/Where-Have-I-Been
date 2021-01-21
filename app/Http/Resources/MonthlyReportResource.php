<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "title" => $this->title,
            "data" => $this->data,
            "created_at" => $this->created_at
        ];
    }
}
