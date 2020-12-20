<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $table = "countries";

    protected $fillable = [
        "name",
    ];

    public function usersProfiles(): BelongsToMany
    {
        return $this->BelongsToMany(UserProfile::class);
    }
}
