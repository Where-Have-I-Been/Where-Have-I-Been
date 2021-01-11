<?php

namespace App\Services\Like;

use App\Exceptions\ResourceException;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Liker;

class LikeService implements LikeServiceInterface
{
    public function createLike(Model $model, Liker $liker): void
    {
        $result = $liker->like($model);

        if ($result === false) {
            throw new ResourceException("you can't create this resource");
        }
    }

    public function deleteLike(Model $model, Liker $liker): void
    {
        $result = $liker->unlike($model);

        if ($result === false) {
            throw new ResourceException("you can't delete this resource");
        }
    }



}
