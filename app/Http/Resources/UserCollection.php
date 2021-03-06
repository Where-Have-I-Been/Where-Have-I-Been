<?php

declare(strict_types=1);

namespace App\Http\Resources;

class UserCollection extends PaginatedCollection
{
    public function toArray($request)
    {
        return [
            "data" => UserResource::collection($this->collection),
            "pagination" => $this->getPaginationLinks($request),
        ];
    }
}
