<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\CountryService;
use App\Services\Interfaces\CountryServiceInterface;
use App\Services\Interfaces\UserProfileServiceInterface;
use App\Services\UserProfileServices\UserProfileService;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Hasher::class, BcryptHasher::class);
        $this->app->bind(UserProfileServiceInterface::class, UserProfileService::class);
        $this->app->bind(CountryServiceInterface::class, CountryService::class);
    }

    public function boot(): void
    {
    }
}
