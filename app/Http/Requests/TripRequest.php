<?php


namespace App\Http\Requests;


class TripRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "name" => [
                "string",
            ],
            "country_id" => [
                "exists:countries,id",
            ],
            "description" => [
                "string",
            ],
            "photo_id" => [
                "string",
                "exists:photos,id",
            ],
            "published" => [
                "bool",
            ],
            "draft" => [
                "bool",
            ],
        ];
    }
}
