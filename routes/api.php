<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\TripController;
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
    $router->get("/photos/user/{user}", [PhotoController::class, "index"])->middleware("can:listPhotos,user");
    $router->delete("/photos/{photo}", [PhotoController::class, "delete"])->middleware("can:deletePhoto,photo");

    $router->post("/trips", [TripController::class, "create"]);
    $router->get("/trips/user/{user}", [TripController::class, "index"]);
    $router->get("/trips/{trip}", [TripController::class, "show"])->middleware("can:view,trip");
    $router->put("/trips/{trip}", [TripController::class, "update"])->middleware("can:changeState,trip");
    $router->delete("/trips/{trip}", [TripController::class, "delete"])->middleware("can:changeState,trip");

    $router->post("/places/trip/{trip}", [PlaceController::class, "create"])->middleware("can:changeState,trip");
    $router->put("/places/{place}", [PlaceController::class, "update"])->middleware("can:changeState,place");
    $router->delete("/places/{place}", [PlaceController::class, "delete"])->middleware("can:changeState,place");

    $router->post("/follows/user/{user}", [FollowController::class, "create"])->middleware("can:createFollow,user");
    $router->delete("/follows/user/{user}", [FollowController::class, "delete"]);
    $router->get("/followers/user/{user}", [FollowController::class, "followersIndex"]);
    $router->get("/following/user/{user}", [FollowController::class, "followingIndex"]);

    $router->post("/likes/trip/{trip}", [LikeController::class, "likeTrip"]);
    $router->delete("/likes/trip/{trip}", [LikeController::class, "likeTrip"]);

    $router->get("/trips-result", [TripController::class, "search"]);

    $router->get("/trips", [TripController::class, "index"]);
});
