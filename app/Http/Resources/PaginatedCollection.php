<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedCollection extends ResourceCollection
{
    protected function getPaginationLinks($request): array
    {
      return  [
            "total" => $this->total(),
            "count" => $this->count(),
            "per_page" => $this->perPage(),
            "current_page" => $this->currentPage(),
            "total_pages" => $this->lastPage(),
        ];
    }

    public function withResponse($request, $response): void
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse["links"],$jsonResponse["meta"]);
        $response->setContent(json_encode($jsonResponse));
    }
}
