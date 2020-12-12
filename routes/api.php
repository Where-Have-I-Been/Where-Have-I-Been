<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use Illuminate\Routing\Router;

$router = app(Router::class);

$router->post("/login", [AuthenticationController::class, "login"]);
$router->post("/register", [AuthenticationController::class, "register"]);
