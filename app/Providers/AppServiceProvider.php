<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Country\CountryService;
use App\Services\Country\CountryServiceInterface;
use App\Services\Follow\FollowService;
use App\Services\Follow\FollowServiceInterface;
use App\Services\Photo\PhotoService;
use App\Services\Photo\PhotoServiceInterface;
use App\Services\UserProfile\UserProfileService;
use App\Services\UserProfile\UserProfileServiceInterface;
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
        $this->app->bind(PhotoServiceInterface::class, PhotoService::class);
        $this->app->bind(FollowServiceInterface::class, FollowService::class);
    }

    public function boot(): void
    {
    }
}
