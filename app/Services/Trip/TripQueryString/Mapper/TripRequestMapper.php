<?php

declare(strict_types=1);

namespace App\Services\Trip\TripQueryString\Mapper;

use App\Services\Trip\TripQueryString\QueryStringData;

class TripRequestMapper implements TripRequestMapperInterface
{
    public function map(array $data): QueryStringData
    {
        $mappedData = new QueryStringData();
        $mappedData = $this->mapFilters($mappedData, $data);
        return $this->mapSortParameter($mappedData, $data);
    }

    private function mapFilters(QueryStringData $mappedData, array $data): QueryStringData
    {
        $mappedData->onlyByFollowings = array_key_exists("only-followings", $data) && $data["only-followings"] === "true";
        $mappedData->onlyByLiked = array_key_exists("only-liked", $data) && $data["only-liked"] === "true";

        if (array_key_exists("city", $data)) {
            $mappedData->city = $data["city"];
        }

        if (array_key_exists("country", $data)) {
            $mappedData->country = $data["country"];
        }

        if (array_key_exists("search-query", $data)) {
            $mappedData->searchQuery = $data["search-query"];
        }

        return $mappedData;
    }

    private function mapSortParameter(QueryStringData $mappedData, array $data): QueryStringData
    {
        if (array_key_exists("sort", $data)) {
            $mappedData->sortByLikes = $data["sort"] === "likes";
            $mappedData->sortByCreated = $data["sort"] === "updated";
            $mappedData->sortByUpdated = $data["sort"] === "created";
        }

        return $mappedData;
    }
}
