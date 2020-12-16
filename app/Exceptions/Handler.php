<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ApiException) {
            return $this->renderJsonResponse($exception->getMessage(), $exception->getCode());
        } elseif ($exception instanceof AuthenticationException) {
            return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        } elseif ($exception instanceof ModelNotFoundException || $exception instanceof RouteNotFoundException) {
            return $this->renderJsonResponse("Not found", Response::HTTP_NOT_FOUND);
        } elseif ($exception instanceof ValidationException) {
            return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, $exception->errors());
        }

        return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function renderJsonResponse(string $message, int $code, array $data = []): JsonResponse
    {
        return response()->json([[
            "message" => $message,
        ], [
            "data" => $data,
        ]], $code);
    }
}
