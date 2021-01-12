<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Services\Search\SearchServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchController extends \Controller
{
    private SearchServiceInterface $service;

    public function __construct(SearchServiceInterface $service)
    {
        $this->service = $service;
    }

    public function trips(Request $request): JsonResource
    {
        $searchResult = $this->service->searchTrips($request->query("search-query"));
        return TripResource::collection($searchResult);
    }
}
