<?php

declare(strict_types=1);

namespace App\Services\CountryService;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface CountryServiceInterface
{
    public function getCountries(): ResourceCollection;
}
