<?php

declare(strict_types=1);

namespace App\Http\Requests;

class UpdateTripRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "string",
            ],
            "description" => [
                "string",
            ],
            "photo_id" => [
                "string",
                "exists:photos,id",
            ],
        ];
    }
}
