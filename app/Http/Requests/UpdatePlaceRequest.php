<?php


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
