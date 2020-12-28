<?php

declare(strict_types=1);

namespace App\Services\Photo;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;

interface PhotoServiceInterface
{
    public function uploadPhoto(UploadedFile $photoFile, User $user): Photo;
    public function deletePhoto(Photo $photo): void;
    public function getUserPhotos(User $userId, array $parameters): Paginator;
}
