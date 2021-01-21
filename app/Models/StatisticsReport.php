<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticsReport extends Model
{
    protected $table = "statistics";

    protected $fillable = [
        "data",
    ];

    protected $casts = [
        "data" => "array",
    ];
}
