<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Routing\Router;

$router = app(Router::class);

$router->post("/login", [AuthenticationController::class, "login"]);
$router->post("/register", [AuthenticationController::class, "register"]);

$router->get("/countries", [CountryController::class, "index"]);

$router->middleware("auth:sanctum")->group(function ($router): void {
    $router->get("/users", [UserController::class, "show"]);
    $router->post("/users/{user}/change-password", [UserController::class, "changePassword"])->middleware("can:changePassword,user");

    $router->get("/profiles/{profile}", [UserProfileController::class, "show"]);
    $router->put("/profiles/{profile}", [UserProfileController::class, "update"])->middleware("can:update,profile");

    $router->post("/photos", [PhotoController::class, "create"]);
    $router->delete("/photos/{photo}", [PhotoController::class, "delete"])->middleware("can:deletePhoto,photo");
    $router->get("/photos/user/{user}", [PhotoController::class, "index"])->middleware("can:listPhotos,user");

    $router->post("/follows/user/{user}", [FollowController::class, "create"])->middleware("can:createFollow,user");
    $router->delete("/follows/user/{user}", [FollowController::class, "delete"]);
    $router->get("/followers/user/{user}", [FollowController::class, "followersIndex"]);
    $router->get("/following/user/{user}", [FollowController::class, "followingIndex"]);
});
