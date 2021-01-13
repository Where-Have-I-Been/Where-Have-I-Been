<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Scopes\LikeFilterable;
use Rennokki\Befriended\Traits\CanBeLiked;

class Trip extends Model implements Likeable
{
    use CanBeLiked;
    use LikeFilterable;
    use Searchable;

    protected $table = "trips";

    protected $fillable = [
        "user_id",
        "photo_id",
        "name",
        "description",
        "published",
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function photo(): BelongsTo
    {
        return $this->BelongsTo(Photo::class);
    }

    public function places(): HasMany
    {
        return $this->HasMany(Place::class);
    }

    public function scopeFollowings(Builder $query, User $user): Builder
    {
        return $query->whereHas("user", function ($query) use ($user) {
            $query->whereHas("followers", function ($query) use ($user) {
                $query->where("follower_id", $user->id);
            });
        });
    }

    public function scopeCity(Builder $query, string $city): Builder
    {
        return $query->orderBy("city",$city);
    }

    public function scopeCountry(Builder $query, string $country): Builder
    {
        return $query->orderBy("city",$country);
    }
}
