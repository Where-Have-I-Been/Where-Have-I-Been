<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Services\AuthenticationServices\AppLoginService;
use App\Http\Services\AuthenticationServices\AppRegisterService;
use App\Http\Services\AuthenticationServices\ValidationHelper;
use App\Http\Services\Interfaces\AppLoginServiceInterface;
use App\Http\Services\Interfaces\AppRegisterServiceInterface;
use App\Http\Services\Interfaces\ValidationHelperInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ValidationHelperInterface::class, function () {
            return new ValidationHelper();
        });
        $this->app->bind(AppLoginServiceInterface::class, function () {
            return new AppLoginService(new ValidationHelper());
        });
        $this->app->bind(AppRegisterServiceInterface::class, function () {
            return new AppRegisterService(new ValidationHelper());
        });
    }

    public function boot(): void
    {
    }
}
