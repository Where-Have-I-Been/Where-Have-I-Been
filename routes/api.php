<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;



Route::post("/login", [\App\Http\Controllers\AuthenticationController::class, "login"]);
Route::post("/register", [\App\Http\Controllers\AuthenticationController::class, "register"]);
Route::post("/logout", [\App\Http\Controllers\AuthenticationController::class, "logout"]);
