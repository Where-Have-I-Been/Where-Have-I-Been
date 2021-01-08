<?php

declare(strict_types=1);

namespace App\Http\Requests;

class TripRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
            ],
            "description" => [
                "required",
                "string",
            ],
            "photo_id" => [
                "string",
                "exists:photos,id",
            ],
        ];
    }
}
