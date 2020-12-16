<?php


namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ValidationException extends ApiException
{
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}

