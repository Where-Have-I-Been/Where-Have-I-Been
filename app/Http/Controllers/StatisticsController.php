<?php

namespace App\Http\Controllers;

use App\Services\Statistics\StatisticsGetter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private StatisticsGetter $getter;

    public function __construct(StatisticsGetter $getter)
    {
        $this->getter = $getter;
    }

    public function show(Request $request): JsonResponse
    {
        $statisticsReport = $this->getter->getStatistics($request->query("month"),$request->query("year"));
        return response()->json($statisticsReport);
    }

}
