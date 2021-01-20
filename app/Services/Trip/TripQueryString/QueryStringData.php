<?php

declare(strict_types=1);

namespace App\Services\Trip\TripQueryString;

class QueryStringData
{
    public bool $onlyByFollowings;
    public bool $onlyByLiked;
    public string $city;
    public string $country;
    public bool $sortByLikes;
    public bool $sortByUpdated;
    public bool $sortByCreated;
    public string $searchQuery;


    public function __construct()
    {
        $this->onlyByFollowings = false;
        $this->onlyByLiked = false;
        $this->city = "";
        $this->country = "";
        $this->sortByLikes = false;
        $this->sortByUpdated = false;
        $this->sortByCreated = false;
        $this->searchQuery = "";

    }

    public function isToBeFiltered(): bool
    {
        return $this->onlyByFollowings || $this->onlyByLiked
            || $this->byCity() || $this->byCountry() || $this->isToBeSearch();
    }

    public function isToBeSearch(): bool
    {
        return $this->searchQuery !== "";
    }

    public function isToBeSorted(): bool
    {
        return $this->sortByLikes || $this->sortByUpdated || $this->sortByCreated;
    }

    public function byCity(): bool
    {
        return $this->city !== "";
    }

    public function byCountry(): bool
    {
        return $this->country !== "";
    }
}
