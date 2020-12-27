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

$router->get("/countries", [CountryController::class, "index"]);


$router->middleware("auth:sanctum")->group(function ($router): void {
    $router->post("/users/{user}/change-password", [UserController::class, "changePassword"])->middleware("can:changePassword,user");

    $router->get("/profiles/{profile}", [UserProfileController::class, "show"]);
    $router->put("/profiles/{profile}", [UserProfileController::class, "update"])->middleware("can:update,profile");
});
