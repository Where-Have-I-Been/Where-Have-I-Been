<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class TripCollection extends ResourceCollection
{
    private User $loggedUser;

    public function __construct($resource,User $user)
    {
        parent::__construct($resource);
        $this->resource = $resource;

        $this->loggedUser = $user;
    }
    public function toArray($request)
    {
        $collection = new Collection();
        foreach ($this->collection as $element){
            $collection->add(new TripResource($element, $this->loggedUser));
        }

        return [
            "data" =>[$collection],
            "pagination" => [
                "total" => $this->total(),
                "count" => $this->count(),
                "per_page" => $this->perPage(),
                "current_page" => $this->currentPage(),
                "total_pages" => $this->lastPage(),
            ],
        ];
    }

    public function withResponse($request, $response): void
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse["links"],$jsonResponse["meta"]);
        $response->setContent(json_encode($jsonResponse));
    }
}
