<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\AuthenticationServices\AppLoginService;
use App\Services\AuthenticationServices\AppRegisterService;
use App\Services\Interfaces\AppLoginServiceInterface;
use App\Services\Interfaces\AppRegisterServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Hashing\BcryptHasher;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AppLoginServiceInterface::class, function () {
            return new AppLoginService(new BcryptHasher());
        });
        $this->app->bind(AppRegisterServiceInterface::class, function () {
            return new AppRegisterService();
        });
    }

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
