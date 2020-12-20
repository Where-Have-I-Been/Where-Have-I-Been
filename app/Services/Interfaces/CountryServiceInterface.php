<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Http\Resources\Json\ResourceCollection;

interface CountryServiceInterface
{
    public function getCountries(): ResourceCollection;
}
