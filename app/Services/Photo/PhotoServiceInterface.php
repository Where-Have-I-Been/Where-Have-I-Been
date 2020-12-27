<?php

namespace App\Services\Photo;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface PhotoServiceInterface
{
    public function uploadPhoto(UploadedFile $photoFile, User $user): Photo;
    public function deletePhoto(Photo $photo): void;
    public function getPhotos(string $userId): Collection;
}
