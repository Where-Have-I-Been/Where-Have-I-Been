<?php

declare(strict_types=1);

namespace App\Services\Photo;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

class PhotoService implements PhotoServiceInterface
{
    public function uploadPhoto(UploadedFile $photoFile, User $user): Photo
    {
        $uploadedPhotoPath = $photoFile->store("/images");

        return $this->createPhoto($uploadedPhotoPath, $user);
    }

    public function deletePhoto(Photo $photo): void
    {
        $storage = app(Filesystem::class);
        $storage->delete(public_path($photo->path));
        $photo->delete();
    }

    public function getUserPhotos(User $user, ?string $perPage): LengthAwarePaginator
    {
        return $user->photos()->paginate($perPage);
    }

    private function createPhoto(string $path, User $user): Photo
    {
        $photo = new Photo([
            "user_id" => $user->id,
            "name" => basename($path),
            "path" => $path,
        ]);
        $photo->save();

        return $photo;
    }
}
