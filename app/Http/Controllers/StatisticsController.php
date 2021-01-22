<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\MonthlyReportCollection;
use App\Http\Resources\MonthlyReportResource;
use App\Models\StatisticsReport;
use App\Services\Statistics\Getter\MonthlyReportsGetter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StatisticsController extends Controller
{
    private MonthlyReportsGetter $getter;

    public function __construct(MonthlyReportsGetter $getter)
    {
        $this->getter = $getter;
    }

    public function show(StatisticsReport $report): JsonResource
    {
        return new MonthlyReportResource($report);
    }

    public function index(Request $request): ResourceCollection
    {
        $statisticsReport = $this->getter->getMonthlyReports($request->input("per-page"));
        return new MonthlyReportCollection($statisticsReport);
    }
}
