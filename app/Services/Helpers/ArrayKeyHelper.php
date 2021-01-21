<?php

declare(strict_types=1);

namespace App\Services\Helpers;

class ArrayKeyHelper implements ArrayKeyHelperInterface
{
    public function addIncrementsKeys(array $data): array
    {
        $newData = [];
        $index = 1;

        foreach ($data as $element) {
            $newData += [
                "position_" . $index++ => $element,
            ];
        }
        return $newData;
    }
}
