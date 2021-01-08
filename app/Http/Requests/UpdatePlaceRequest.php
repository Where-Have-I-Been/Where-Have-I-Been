<?php

declare(strict_types=1);

namespace App\Http\Requests;

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
        ];
    }
}
