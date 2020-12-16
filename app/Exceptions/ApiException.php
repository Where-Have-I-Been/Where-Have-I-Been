<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ApiException extends Exception
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected array $data;

    public function __construct(array $data, string $message)
    {
        parent::__construct($message);

        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
