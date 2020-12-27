<?php

namespace App\Services\Photo;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PhotoService implements PhotoServiceInterface
{
    public function uploadPhoto(UploadedFile $photoFile, User $user): Photo
    {
        $photoName = $this->createPhotoName($photoFile);
        $uploadedPhotoPath = $photoFile->storeAs("/images", $photoName);

        return $this->createPhoto($uploadedPhotoPath, $photoName, $user);
    }

    public function deletePhoto(Photo $photo): void
    {
        unlink(public_path($photo["path"]));
        $photo->delete();
    }

    public function getPhotos(string $userId): Collection
    {
        /** @var User $user */
       $user = User::query()->where("id",$userId)->first();
        return $user->photo()->get();
    }

    private function createPhotoName(UploadedFile $photoFile): string
    {
        return Str::random(3)."_".$photoFile->getClientOriginalName();
    }

    private function createPhoto(string $path, string $name, User $user): Photo
    {
        $photo = new Photo([
            "user_id" => $user["id"],
            "name" => $name,
            "path" => $path,
        ]);
        $photo->save();

        return $photo;
    }
}
