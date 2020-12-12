<?php

declare(strict_types=1);

use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

return [
    "stateful" => explode(",", env(
        "SANCTUM_STATEFUL_DOMAINS",
        "localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1"
    )),

    "expiration" => null,

    "middleware" => [
        "verify_csrf_token" => VerifyCsrfToken::class,
        "encrypt_cookies" => EncryptCookies::class,
    ],
];
