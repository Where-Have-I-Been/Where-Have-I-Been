<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Models\UserProfile;
use App\Policies\UserPolicy;
use App\Policies\UserProfilePolicy;
use App\Services\CountryService\AuthenticationServices\RegisterService\PasswordService\LoginService\LoginService;
use App\Services\CountryService\AuthenticationServices\RegisterService\PasswordService\LoginService\LoginServiceInterface;
use App\Services\CountryService\AuthenticationServices\RegisterService\PasswordService\PasswordService;
use App\Services\CountryService\AuthenticationServices\RegisterService\PasswordService\PasswordServiceInterface;
use App\Services\CountryService\AuthenticationServices\RegisterService\RegisterService;
use App\Services\CountryService\AuthenticationServices\RegisterService\RegisterServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserProfile::class => UserProfilePolicy::class,
        User::class => UserPolicy::class,
    ];

    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(RegisterServiceInterface::class, RegisterService::class);
        $this->app->bind(PasswordServiceInterface::class, PasswordService::class);
    }

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
