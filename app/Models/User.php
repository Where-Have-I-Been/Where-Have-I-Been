<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticated
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

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
}
