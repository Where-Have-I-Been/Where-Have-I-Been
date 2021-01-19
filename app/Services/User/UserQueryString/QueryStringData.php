<?php


namespace App\Services\User\UserQueryString;


class QueryStringData
{
    public bool $byFollowings;
    public bool $byFriends;
    public string $searchQuery;

    public function __construct()
    {
        $this->byFollowings = false;
        $this->byFriends = false;
        $this->searchQuery = "";

    }

    public function isToBeFiltered(): bool
    {
        return $this->byFollowings || $this->byFriends;
    }

    public function isToBeSearch(): bool
    {
        return $this->searchQuery !== "";
    }
}
