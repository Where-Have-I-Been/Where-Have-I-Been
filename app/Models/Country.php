<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = "countries";

    protected $fillable = [
        "name",
    ];

    public function usersProfiles(): HasMany
    {
        return $this->HasMany(UserProfile::class);
    }
}
