<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Services\Filter\FilterServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterController
{
    private FilterServiceInterface $service;

    public function __construct(FilterServiceInterface $service)
    {
        $this->service = $service;
    }

    public function trips(Request $request): JsonResource
    {
        $searchResult = $this->service->trips("");
        return TripResource::collection($searchResult);
    }
}
