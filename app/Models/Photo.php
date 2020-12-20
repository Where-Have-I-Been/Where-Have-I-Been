<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    protected $table = "photos";

    protected $fillable = [
        "path",
    ];

    public function usersProfiles(): BelongsToMany
    {
        return $this->BelongsToMany(UserProfile::class);
    }
}
