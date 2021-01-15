<?php

declare(strict_types=1);

namespace App\Models;

use App\Scopes\FollowingsFilterable;
use App\Scopes\TripFilters;
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
    use TripFilters;
    use FollowingsFilterable;

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
}
