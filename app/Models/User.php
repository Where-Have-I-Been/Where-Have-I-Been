<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rennokki\Befriended\Contracts\Following;
use Rennokki\Befriended\Contracts\Liker;
use Rennokki\Befriended\Traits\CanLike;
use Rennokki\Befriended\Traits\Follow;

class User extends Authenticated implements Following, Liker
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Follow;
    use CanLike;

    protected $table = "users";

    protected $fillable = [
        "email",
        "password",
    ];

    protected $hidden = [
        "password",
    ];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    public function userProfile(): HasOne
    {
        return $this->HasOne(UserProfile::class);
    }

    public function photos(): HasMany
    {
        return $this->HasMany(Photo::class);
    }

    public function places(): HasMany
    {
        return $this->HasMany(Place::class);
    }

    public function trips(): HasMany
    {
        return $this->HasMany(Trip::class);
    }

    public function scopeByFollowings(Builder $query, User $user): Builder
    {
        return  $query->whereHas("followers", function (Builder $query) use ($user): void {
            $query->where("follower_id", $user->id);
        });
    }

    public function scopeByFollowers(Builder $query, User $user): Builder
    {
        return  $query->whereHas("followers", function (Builder $query) use ($user): void {
            $query->where("followable_id", $user->id);
        });
    }

    public function scopeSearch(Builder $query, string $searchQuery): Builder
    {
        return $query->whereHas("userProfile",function (Builder $query) use ($searchQuery){
            $query->where("name","like","%{$searchQuery}%");
        })->orWhere("email", "like", "%{$searchQuery}%");
    }
}
