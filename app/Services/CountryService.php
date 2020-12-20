<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Services\Interfaces\CountryServiceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryService implements CountryServiceInterface
{
    public function getCountries(): ResourceCollection
    {
        return CountryResource::collection(Country::query()->get());
    }
}
