<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            "current_password" => [
                "required",

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
