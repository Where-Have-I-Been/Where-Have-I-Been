<?php

declare(strict_types=1);

namespace App\Services\Like;

use App\Events\NewLikeEvent;
use App\Exceptions\ResourceException;
use App\Models\Trip;
use App\Models\User;

class TripTripLikeService implements TripLikeServiceInterface
{
    public function createLike(Trip $model, User $liker): void
    {
        $result = $liker->like($model);

        if ($result === false) {
            throw new ResourceException("you can't create this resource");
        }

        $this->incrementLikesCount($model);
        event(new NewLikeEvent($model, $liker));
    }

    public function deleteLike(Trip $model, User $liker): void
    {
        $result = $liker->unlike($model);

        if ($result === false) {
            throw new ResourceException("you can't delete this resource");
        }

        $this->decrementLikesCount($model);
    }

    private function incrementLikesCount(Trip $model): void
    {
        ++$model->likes_count;
        $model->save();
    }

    private function decrementLikesCount(Trip $model): void
    {
        --$model->likes_count;
        $model->save();
    }
}
