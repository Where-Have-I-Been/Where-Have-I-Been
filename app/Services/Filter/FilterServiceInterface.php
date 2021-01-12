<?php

namespace App\Services\Filter;

use Illuminate\Database\Eloquent\Collection;

interface FilterServiceInterface
{
    public function trips(string $parameter): Collection;
}
