<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Models\UserProfile;
use App\Policies\UserPolicy;
use App\Policies\UserProfilePolicy;
use App\Services\AuthenticationServices\LoginService\LoginService;
use App\Services\AuthenticationServices\LoginService\LoginServiceInterface;
use App\Services\AuthenticationServices\PasswordService\PasswordService;
use App\Services\AuthenticationServices\PasswordService\PasswordServiceInterface;
use App\Services\AuthenticationServices\RegisterService\RegisterService;
use App\Services\AuthenticationServices\RegisterService\RegisterServiceInterface;
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
