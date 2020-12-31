<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FollowCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            "data" => $this->collection,
            "count" => $this->collection->count(),
        ];
    }
}
