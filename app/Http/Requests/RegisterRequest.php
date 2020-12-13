<?php

declare(strict_types=1);

namespace App\Http\Requests;

class RegisterRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "email" => [
                "required",
                "unique:users",
            ],
            "password" => [
                "required",
                "string",
                "min:6",
                "confirmed",
            ],
        ];
    }
}
