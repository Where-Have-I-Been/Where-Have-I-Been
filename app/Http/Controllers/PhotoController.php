<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use App\Models\User;
use App\Services\Photo\PhotoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    private PhotoServiceInterface $service;

    public function __construct(PhotoServiceInterface $service)
    {
        $this->service = $service;
    }

    public function indexOfPhotos(User $user, Request $request): ResourceCollection
    {
        $photosWithPagination = $this->service->getUserPhotos($user, $request->query("per-page"));

        return PhotoResource::collection($photosWithPagination);
    }

    public function create(PhotoRequest $request): JsonResponse
    {
        $photo = $this->service->uploadPhoto($request->file("image"), $request->user());

        return response()->json([
            "message" => __("resources.image_uploaded"),
            "data" => new PhotoResource($photo),
        ],
            Response::HTTP_OK);
    }

    public function delete(Photo $photo): JsonResponse
    {
        $this->service->deletePhoto($photo);

        return response()->json([
            "message" => __("resources.deleted"),
        ],
            Response::HTTP_OK);
    }
}
