<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlacePhoto extends Model
{
    protected $table = "place_photo";

    protected $fillable = [
        "photo_id",
        "place_id",
    ];

    public function photo(): BelongsTo
    {
        return $this->BelongsTo(Photo::class);
    }

    public function place(): BelongsTo
    {
        return $this->BelongsTo(Place::class);
    }
}
