<?php

namespace App\Services\Filter;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class FilterService implements FilterServiceInterface
{
    public function trips(string $parameter): Collection
    {
            Trip::query()->orderBy($parameter)->get();
    }
}
