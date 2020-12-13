<?php

declare(strict_types=1);

namespace App\Http\Requests;

class LoginRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            "email" => "required",
            "password" => "required",
        ];
    }
}
