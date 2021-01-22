<?php

declare(strict_types=1);

namespace App\Services\User\UserQueryString;

class QueryStringData
{
    public bool $byFollowings;
    public bool $byFollowers;
    public string $searchQuery;

    public function __construct()
    {
        $this->byFollowings = false;
        $this->byFollowers = false;
        $this->searchQuery = "";
    }

    public function isToBeFiltered(): bool
    {
        return $this->byFollowings || $this->byFollowers || $this->isToBeSearch();
    }

    public function isToBeSearch(): bool
    {
        return $this->searchQuery !== "";
    }
}
