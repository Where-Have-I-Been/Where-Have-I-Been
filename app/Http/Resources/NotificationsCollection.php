<?php

namespace App\Http\Resources;

class NotificationsCollection extends PaginatedCollection
{
    public function toArray($request)
    {
        return [
            "data" => NotificationResource::collection($this->collection),
            "pagination" => $this->getPaginationLinks($request),
        ];
    }
}
