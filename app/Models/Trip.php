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
    use Searchable;
    use LikeFilterable;

    protected $table = "trips";

    protected $fillable = [
        "user_id",
        "photo_id",
        "name",
        "description",
        "published",
        "likes",
    ];

    protected $casts = [
        "published" => "boolean",
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

    public function scopeByFollowings(Builder $query, User $user): Builder
    {
            return $query->whereHas($user, function (Builder $query) use ($user): void {
                $query->whereHas("followers", function (Builder $query) use ($user): void {
                    $query->where("follower_id", $user->id);
                });
            });
    }

    public function scopeByCity(Builder $query, string $city): Builder
    {
        return $query->whereHas("places", function (Builder $query) use ($city): void {
            $query->where("city", $city);
        });
    }

    public function scopeByCountry(Builder $query, string $country): Builder
    {
        return $query->whereHas("places", function (Builder $query) use ($country): void {
            $query->where("country", $country);
        });
    }
}
