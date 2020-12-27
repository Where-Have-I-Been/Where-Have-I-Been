<?php

declare(strict_types=1);

namespace App\Services\Country;

use Illuminate\Support\Collection;

interface CountryServiceInterface
{
    public function getCountries(): Collection;
}
