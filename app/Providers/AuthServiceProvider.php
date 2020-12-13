<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\AuthenticationServices\LoginService;
use App\Services\AuthenticationServices\RegisterService;
use App\Services\Interfaces\LoginServiceInterface;
use App\Services\Interfaces\RegisterServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Hashing\BcryptHasher;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, function () {
            return new LoginService(new BcryptHasher());
        });
        $this->app->bind(RegisterServiceInterface::class, function () {
            return new RegisterService(new BcryptHasher());
        });
    }

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
