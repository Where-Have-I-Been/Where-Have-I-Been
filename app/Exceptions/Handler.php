<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ApiException) {
            return $this->renderJsonResponse($exception->getMessage(), $exception->getCode());
        }
        if ($exception instanceof AuthenticationException) {
            return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
        if ($exception instanceof ModelNotFoundException || $exception instanceof RouteNotFoundException || $exception instanceof NotFoundHttpException) {
            return $this->renderJsonResponse("Not found", Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof ValidationException) {
            return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, $exception->errors());
        }
        if ($exception instanceof AuthorizationException) {
            return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        return $this->renderJsonResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function renderJsonResponse(string $message, int $code, array $data = []): JsonResponse
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
        ], $code);
    }
}
