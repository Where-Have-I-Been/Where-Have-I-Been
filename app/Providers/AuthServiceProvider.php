<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\AuthenticationServices\LoginService;
use App\Services\AuthenticationServices\RegisterService;
use App\Services\Interfaces\LoginServiceInterface;
use App\Services\Interfaces\RegisterServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(RegisterServiceInterface::class, RegisterService::class);
    }

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
