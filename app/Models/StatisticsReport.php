<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticsReport extends Model
{
    protected $table = "statistics";

    protected $fillable = [
        "data",
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
