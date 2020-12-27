<?php


namespace App\Policies;


use App\Models\Photo;
use App\Models\User;

class PhotoPolicy
{
    public function deletePhoto(User $user, Photo $photo)
    {
        return $photo->user()->is($user);
    }
}
