<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
