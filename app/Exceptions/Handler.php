<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($request->isJson() || $exception instanceof ApiException) {
            return response()->json(
                [
                    "message" => $exception->getMessage(),
                ],
                $exception->getCode() ?? Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        return parent::render($request, $exception);
    }
}
