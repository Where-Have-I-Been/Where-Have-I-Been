<?php

declare(strict_types=1);

namespace App\Services\Country;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryService implements CountryServiceInterface
{
    public function getCountries(): ResourceCollection
    {
        return CountryResource::collection(Country::query()->get());
    }
}
