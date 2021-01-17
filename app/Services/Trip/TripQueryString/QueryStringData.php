<?php

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

    public function __construct()
    {
        $this->onlyByFollowings = false;
        $this->onlyByLiked = false;
        $this->city = "";
        $this->country = "";
        $this->sortByLikes = false;
        $this->sortByUpdated = false;
        $this->sortByCreated = false;
    }

    public function isToBeFiltered(): bool
    {
        return $this->onlyByFollowings || $this->onlyByLiked
            || $this->city != "" || $this->country != "";
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
