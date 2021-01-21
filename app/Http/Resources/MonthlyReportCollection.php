<?php

declare(strict_types=1);

namespace App\Http\Resources;

class MonthlyReportCollection extends PaginatedCollection
{
    public function toArray($request)
    {
        return [
            "data" => MonthlyReportResource::collection($this->collection),
            "pagination" => $this->getPaginationLinks($request),
        ];
    }
}
