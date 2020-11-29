<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
$router = app(Router::class);

$router->middleware("auth:api")->get("/user", function (Request $request): User {
    return $request->user();

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
