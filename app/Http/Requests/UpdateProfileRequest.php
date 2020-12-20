<?php

declare(strict_types=1);

namespace App\Http\Requests;

class UpdateProfileRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "string",
            ],
            "country_name" => [
                "string",
                "exists:countries"
            ],
            "gender" => [
                "string",
            ],
            "birth_date" => [
                "date",
                "date_format:Y-m-d",
            ],
            "description" => [
                "string",
            ],
        ];
    }
}
