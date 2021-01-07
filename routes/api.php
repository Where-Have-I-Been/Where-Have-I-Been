<?php

declare(strict_types=1);

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CountryController;
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
    $router->post("/users/{user}/change-password", [UserController::class, "changePassword"])->middleware("can:changePassword,user");

    $router->get("/profiles/{profile}", [UserProfileController::class, "show"]);
    $router->put("/profiles/{profile}", [UserProfileController::class, "update"])->middleware("can:update,profile");

    $router->post("/photos", [PhotoController::class, "create"]);
    $router->delete("/photos/{photo}", [PhotoController::class, "delete"])->middleware("can:deletePhoto,photo");
    $router->get("/photos/user/{user}", [PhotoController::class, "index"])->middleware("can:listPhotos,user");

    $router->get("/trips/{trip}", [TripController::class, "show"]);
    $router->get("/trips", [TripController::class, "index"]);
    $router->post("/trips", [TripController::class, "create"]);
    $router->put("/trips/{trip}", [TripController::class, "update"])->middleware("can:access,trip");
    $router->delete("/trips/{trip}", [TripController::class, "delete"])->middleware("can:access,trip");
    $router->put("/trips/{trip}/publish", [TripController::class, "publish"])->middleware("can:access,trip");

    $router->post("/places", [PlaceController::class, "create"]);
    $router->patch("/places/{place}", [PlaceController::class, "addPhoto"])->middleware("can:access,place");
    $router->put("/places/{place}", [PlaceController::class, "update"])->middleware("can:access,place");
    $router->delete("/places/{place}", [PlaceController::class, "delete"])->middleware("can:access,place");
});
