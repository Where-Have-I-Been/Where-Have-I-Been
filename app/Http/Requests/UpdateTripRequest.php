<?php


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
