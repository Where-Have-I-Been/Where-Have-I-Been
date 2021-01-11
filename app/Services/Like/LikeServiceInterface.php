<?php

namespace App\Services\Like;

use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Liker;

interface LikeServiceInterface
{
    public function createLike(Model $model, Liker $liker): void;
    public function deleteLike(Model $model, Liker $liker): void;

}
