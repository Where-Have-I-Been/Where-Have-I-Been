<?php

declare(strict_types=1);

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Befriended\Contracts\Follower;

trait FollowingsFilterable
{
    public function scopeByFollowings(Builder $query, Model $model): Builder
    {
        if ($model instanceof Follower) {
            return $query->whereHas($this->getClassName($model), function ($query) use ($model): void {
                $query->whereHas("followers", function ($query) use ($model): void {
                    $query->where("follower_id", $model->id);
                });
            });
        }
        return $query;
    }

    private function getClassName(Model $model): string
    {
        $reflect = new \ReflectionClass($model);
        return $reflect->getShortName();
    }
}
