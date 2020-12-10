<?php


namespace App\Http\Services\AuthenticationServices;



use BenSampo\Enum\Enum;

final class ValidationRules extends Enum
{
     const Login = [
        "email" => "required",
        "password" => "required",
    ];

    const Register = [
        "email" => [
            "required",
            "unique:users",
        ],
        "password" => [
            "required",
            "string",
            "min:6",
            "confirmed",
        ]];
}
