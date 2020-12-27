<?php

declare(strict_types=1);

namespace App\Services\Country;

use App\Models\Country;
use Illuminate\Support\Collection;


class CountryService implements CountryServiceInterface
{
    public function getCountries(): Collection
    {
        return collect(Country::query()->get());
    }
}
