<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserProfile extends Model
{
    protected $table = "users_profiles";

    protected $fillable = [
        "name",
        "description",
        "gender",
        "nationality",
        "birthdate",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }

    public function photo(): HasOne
    {
        return $this->hasOne(Photo::class);
    }
}
