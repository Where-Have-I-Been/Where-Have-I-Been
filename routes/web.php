<?php

declare(strict_types=1);

use Illuminate\Routing\Router;

/** @var Router $router */
$router = app(Router::class);

$router->get("/", function () {
    return view("welcome");
});

$router->post('/login', [\App\Http\Controllers\AuthenticationController::class,"login"]);
$router->post('/register', ["app\Http\Controllers\AuthenticationController@register"]);
