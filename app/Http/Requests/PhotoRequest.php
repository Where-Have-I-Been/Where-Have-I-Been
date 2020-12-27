<?php


namespace App\Http\Requests;


class PhotoRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "image" => "required|image:jpeg,png,jpg,svg|max:4096",
        ];
    }
}
