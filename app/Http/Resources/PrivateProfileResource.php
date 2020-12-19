<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class PrivateProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "birth_date" => $this->birth_date,
            "gender" => $this->gender,
            "nationality" => $this->nationality,
            "description" => $this->description,
        ];
    }
}
