<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlacePhoto extends Model
{
    protected $table = "placePhotos";

    protected $fillable = [
        "user_id",
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
