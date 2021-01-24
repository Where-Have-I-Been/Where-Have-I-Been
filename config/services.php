<?php

declare(strict_types=1);

return [
    "mailgun" => [
        "domain" => env("MAILGUN_DOMAIN"),
        "secret" => env("MAILGUN_SECRET"),
        "endpoint" => env("MAILGUN_ENDPOINT", "api.mailgun.net"),
    ],
    "postmark" => [
        "token" => env("POSTMARK_TOKEN"),
    ],
    "ses" => [
        "key" => env("AWS_ACCESS_KEY_ID"),
        "secret" => env("AWS_SECRET_ACCESS_KEY"),
        "region" => env("AWS_DEFAULT_REGION", "us-east-1"),
    ],
    "facebook" => [
        "client_id" => env("FACEBOOK_ID"),
        "client_secret" => env("FACEBOOK_SECRET"),
        "redirect" => env("APP_URL") . "/facebook/callback/",
        ],
];
