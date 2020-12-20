<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Routing\Router;

$router = app(Router::class);
$router->post("/login", [AuthenticationController::class, "login"]);
$router->post("/register", [AuthenticationController::class, "register"]);
$router->patch("/users/{user}", [UserController::class, "update"])->middleware("auth:sanctum");

$router->put("/profiles/{profile}", [UserProfileController::class, "update"])->middleware("auth:sanctum");
$router->get("/profiles/{profile}", [UserProfileController::class, "show"])->middleware("auth:sanctum");

$router->get("/countries", [CountryController::class, "index"]);
