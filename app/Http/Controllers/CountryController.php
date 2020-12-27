<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Services\Country\CountryServiceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountryController extends Controller
{
    public function index(CountryServiceInterface $service): ResourceCollection
    {
        return CountryResource::collection($service->getCountries());
    }
}
