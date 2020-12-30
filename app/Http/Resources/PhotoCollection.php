<?php

declare(strict_types=1);

namespace App\Http\Resources;

class PhotoCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            "data" => $this->collection,
        ];
    }
}
