<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Country\CountryService;
use App\Services\Country\CountryServiceInterface;
use App\Services\Follow\FollowService;
use App\Services\Follow\FollowServiceInterface;
use App\Services\Like\TripLikeServiceInterface;
use App\Services\Like\TripTripLikeService;
use App\Services\Photo\PhotoService;
use App\Services\Photo\PhotoServiceInterface;
use App\Services\Place\PlaceService;
use App\Services\Place\PlaceServiceInterface;
use App\Services\Search\SearchService;
use App\Services\Search\SearchServiceInterface;
use App\Services\Statistics\StatisticsGenerator;
use App\Services\Statistics\StatisticsGeneratorInterface;
use App\Services\Statistics\StatisticsGetter;
use App\Services\Statistics\StatisticsGetterInterface;
use App\Services\Statistics\StatisticsWriter;
use App\Services\Statistics\StatisticsWriterInterface;
use App\Services\Trip\Filter\TripFilter;
use App\Services\Trip\Filter\TripFilterInterface;
use App\Services\Trip\Sorter\TripSorter;
use App\Services\Trip\Sorter\TripSorterInterface;
use App\Services\Trip\TripQueryString\Mapper\TripRequestMapper;
use App\Services\Trip\TripQueryString\Mapper\TripRequestMapperInterface;
use App\Services\Trip\TripService;
use App\Services\Trip\TripServiceInterface;
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
        $this->app->bind(TripServiceInterface::class, TripService::class);
        $this->app->bind(PlaceServiceInterface::class, PlaceService::class);
        $this->app->bind(FollowServiceInterface::class, FollowService::class);
        $this->app->bind(TripLikeServiceInterface::class, TripTripLikeService::class);
        $this->app->bind(TripFilterInterface::class, TripFilter::class);
        $this->app->bind(TripSorterInterface::class, TripSorter::class);
        $this->app->bind(TripRequestMapperInterface::class, TripRequestMapper::class);


        $this->app->bind(StatisticsGeneratorInterface::class, StatisticsGenerator::class);
        $this->app->bind(StatisticsGetterInterface::class, StatisticsGetter::class);
        $this->app->bind(StatisticsWriterInterface::class, StatisticsWriter::class);
    }

    public function boot(): void
    {
    }
}
