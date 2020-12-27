<?php


namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\Photo\PhotoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    private PhotoServiceInterface $service;

    public function __construct(PhotoServiceInterface $service)
    {
        $this->service = $service;
    }

    public function create(Request $request): JsonResponse
    {
        $photo = $this->service->uploadPhoto($request->file("image"), $request->user());

        return response()->json([
            "message" =>"Photo was uploaded successfully",
            "data"=> $photo["id"]],
            Response::HTTP_OK);
    }

    public function show(Photo $photo): BinaryFileResponse
    {
        return response()->file(public_path($photo["path"]));
    }

    public function delete(Photo $photo): JsonResponse
    {
        $this->service->deletePhoto($photo);

        return response()->json([
            "message" =>"Photo was deleted successfully",
        ],
            Response::HTTP_OK);
    }
}
