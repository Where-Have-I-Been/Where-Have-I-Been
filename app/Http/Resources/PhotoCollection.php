<?php

namespace App\Http\Resources;

class PhotoCollection extends PaginatedCollection
{
    public function toArray($request)
    {
        return [
            "data" => PhotoResource::collection($this->collection),
            "pagination" => $this->getPaginationLinks($request),
        ];
    }
}
