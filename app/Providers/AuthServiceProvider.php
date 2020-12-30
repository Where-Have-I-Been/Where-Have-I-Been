<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Photo;
use App\Models\User;
use App\Models\UserProfile;
use App\Policies\PhotoPolicy;
use App\Policies\UserPolicy;
use App\Policies\UserProfilePolicy;
use App\Services\Authentication\Login\LoginService;
use App\Services\Authentication\Login\LoginServiceInterface;
use App\Services\Authentication\Password\PasswordService;
use App\Services\Authentication\Password\PasswordServiceInterface;
use App\Services\Authentication\Register\RegisterService;
use App\Services\Authentication\Register\RegisterServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        UserProfile::class => UserProfilePolicy::class,
        User::class => UserPolicy::class,
        Photo::class => PhotoPolicy::class,
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
