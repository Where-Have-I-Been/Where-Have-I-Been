<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $table = "countries";

    protected $fillable = [
        "name",
        "code",
        "flag_url",
    ];

    public function usersProfiles(): BelongsToMany
    {
        return $this->BelongsToMany(UserProfile::class);
    }
}
