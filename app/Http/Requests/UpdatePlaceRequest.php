<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\PhotoExists;

class UpdatePlaceRequest extends ApiRequest
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
            "photos.*" => [
                "string",
                new PhotoExists($this->user()),
            ],
        ];
    }
}
