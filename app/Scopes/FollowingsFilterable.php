<?php

declare(strict_types=1);

namespace App\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait FollowingsFilterable
{
    public function scopeByFollowings(Builder $query, User $user): Builder
    {
        return $query->whereHas("user", function ($query) use ($user): void {
            $query->whereHas("followers", function ($query) use ($user): void {
                $query->where("follower_id", $user->id);
            });
        });
    }
}
