<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\PhotoExists;

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
                new PhotoExists($this->user()),
            ],
        ];
    }
}
