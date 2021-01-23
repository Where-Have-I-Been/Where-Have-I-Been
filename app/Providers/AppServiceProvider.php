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
use App\Services\Statistics\Generator\MonthlyReportsGenerator;
use App\Services\Statistics\Generator\MonthlyReportsGeneratorInterface;
use App\Services\Statistics\Getter\MonthlyReportsGetter;
use App\Services\Statistics\Provider\StatisticsDataProvider;
use App\Services\Statistics\Provider\StatisticsDataProviderInterface;
use App\Services\Statistics\Saver\StatisticsSaver;
use App\Services\Statistics\Saver\StatisticsSaverInterface;
use App\Services\Trip\Filter\TripFilter;
use App\Services\Trip\Filter\TripFilterInterface;
use App\Services\Trip\Sorter\TripSorter;
use App\Services\Trip\Sorter\TripSorterInterface;
use App\Services\Trip\TripQueryString\Mapper\TripRequestMapper;
use App\Services\Trip\TripQueryString\Mapper\TripRequestMapperInterface;
use App\Services\Trip\TripService;
use App\Services\Trip\TripServiceInterface;
use App\Services\User\Filter\UserFilter;
use App\Services\User\Filter\UserFilterInterface;
use App\Services\User\Statistics\UserStatisticsGetter;
use App\Services\User\Statistics\UserStatisticsGetterInterface;
use App\Services\User\UserQueryString\Mapper\UserMapper;
use App\Services\User\UserQueryString\Mapper\UserMapperInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
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

        $this->app->bind(PlaceServiceInterface::class, PlaceService::class);

        $this->app->bind(FollowServiceInterface::class, FollowService::class);

        $this->app->bind(TripServiceInterface::class, TripService::class);
        $this->app->bind(TripLikeServiceInterface::class, TripTripLikeService::class);
        $this->app->bind(TripFilterInterface::class, TripFilter::class);
        $this->app->bind(TripSorterInterface::class, TripSorter::class);
        $this->app->bind(TripRequestMapperInterface::class, TripRequestMapper::class);

        $this->app->bind(MonthlyReportsGeneratorInterface::class, MonthlyReportsGenerator::class);
        $this->app->bind(MonthlyReportsGetter::class, MonthlyReportsGetter::class);
        $this->app->bind(StatisticsSaverInterface::class, StatisticsSaver::class);
        $this->app->bind(StatisticsDataProviderInterface::class, StatisticsDataProvider::class);

        $this->app->bind(UserMapperInterface::class, UserMapper::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserFilterInterface::class, UserFilter::class);

        $this->app->bind(UserStatisticsGetterInterface::class, UserStatisticsGetter::class);
    }

    public function boot(): void
    {
    }
}
