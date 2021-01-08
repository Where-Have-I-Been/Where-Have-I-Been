<?php

declare(strict_types=1);

namespace App\Http\Requests;

class PlaceRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
            ],
            "country" => [
                "required",
                "string",
            ],
            "city" => [
                "required",
                "string",
            ],
            "description" => [
                "required",
                "string",
            ],
            "lng" => [
                "required",
            ],
            "lat" => [
                "required",
            ],
        ];
    }
}
