<?php


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
            "country_id" => [
                "required",
                "exists:countries,id",
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
                "decimal",
            ],
            "lat" => [
                "required",
                "decimal",
            ],
        ];
    }
}
