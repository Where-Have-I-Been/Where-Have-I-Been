<?php


namespace App\Services\User\UserQueryString\Mapper;


use App\Services\User\UserQueryString\QueryStringData;

class UserMapper implements UserMapperInterface
{

    public function map(array $data): QueryStringData
    {
        $mappedData = new QueryStringData();
        $mappedData->byFollowings = array_key_exists("by-followings", $data) && $data["by-followings"] === "true";
        $mappedData->byFriends = array_key_exists("by-friends", $data) && $data["by-friends"] === "true";

        if (array_key_exists("search-query", $data)){
            $mappedData->searchQuery = $data["search-query"];
        }

        return $mappedData;
    }
}
