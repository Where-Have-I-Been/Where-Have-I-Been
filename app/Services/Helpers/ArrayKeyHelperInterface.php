<?php

declare(strict_types=1);

namespace App\Services\Helpers;

interface ArrayKeyHelperInterface
{
    public function addIncrementsKeys(array $data): array;
}
