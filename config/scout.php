<?php

declare(strict_types=1);

return [
    "driver" => env("SCOUT_DRIVER", "algolia"),
    "prefix" => env("SCOUT_PREFIX", ""),
    "queue" => env("SCOUT_QUEUE", true),
    "after_commit" => false,
    "chunk" => [
        "searchable" => 500,
        "unsearchable" => 500,
    ],
    "soft_delete" => false,
    "identify" => env("SCOUT_IDENTIFY", true),
    "algolia" => [
        "id" => env("ALGOLIA_APP_ID", ""),
        "secret" => env("ALGOLIA_SECRET", ""),
    ],
];
