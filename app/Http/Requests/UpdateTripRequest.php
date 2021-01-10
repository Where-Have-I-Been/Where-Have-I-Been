<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\PhotoExists;

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
            "published" => [
                "boolean",
            ],
            "photo_id" => [
                "string",
                new PhotoExists($this->user()),
            ],
        ];
    }
}
