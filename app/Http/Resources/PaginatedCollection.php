<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->getCollection(),
            'links' => [
                'last_page' => $this->lastPage(),
            ],
        ];
    }
}
