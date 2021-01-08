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
    $router->get("/photos/user/{user}", [PhotoController::class, "index"])->middleware("can:listPhotos,user");
    $router->delete("/photos/{photo}", [PhotoController::class, "delete"])->middleware("can:deletePhoto,photo");

    $router->post("/trips", [TripController::class, "create"]);
    $router->get("/trips/user/{user}", [TripController::class, "index"]);
    $router->get("/trips/{trip}", [TripController::class, "show"])->middleware("can:getTrip,trip");
    $router->put("/trips/{trip}", [TripController::class, "update"])->middleware("can:changeState,trip");
    $router->delete("/trips/{trip}", [TripController::class, "delete"])->middleware("can:changeState,trip");
    $router->patch("/trips/{trip}/publish", [TripController::class, "publish"])->middleware("can:changeState,trip");

    $router->post("/places/trip/{trip}", [PlaceController::class, "create"])->middleware("can:changeState,trip");
    $router->put("/places/{place}", [PlaceController::class, "update"])->middleware("can:changeState,place");
    $router->delete("/places/{place}", [PlaceController::class, "delete"])->middleware("can:changeState,place");
    $router->patch("/places/{place}", [PlaceController::class, "addPhoto"])->middleware("can:changeState,place");
});
