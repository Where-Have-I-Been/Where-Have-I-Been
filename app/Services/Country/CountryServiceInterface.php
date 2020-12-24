<?php

declare(strict_types=1);

namespace App\Services\Country;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface CountryServiceInterface
{
    public function getCountries(): ResourceCollection;
}
