<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UnauthenticatedException extends ApiException
{
    protected $code = Response::HTTP_UNAUTHORIZED;
}
