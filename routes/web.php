<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->get("/", function () {
    return view("welcome");
});

$router->get("/facebook", [AuthenticationController::class, "redirectToFacebook"]);
$router->get("/facebook/callback", [AuthenticationController::class, "handleFacebookCallback"]);
