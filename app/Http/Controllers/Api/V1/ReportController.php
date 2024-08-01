<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller {

    public function index(): JsonResponse {
        $reportsByDate = Report::query()->selectRaw('
            date, 
            sum(revenue) as total_revenue, 
            sum(impressions) as total_impressions, 
            sum(clicks) as total_clicks'
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->mapWithKeys(function ($item) {
            $cpm = $item->total_impressions > 0 ? ($item->total_revenue * 1000) / $item->total_impressions : 0;
            return [
                $item->date => [
                    'revenue' => $item->total_revenue,
                    'impressions' => $item->total_impressions,
                    'clicks' => $item->total_clicks,
                    'cpm' => number_format($cpm, 2)
                ]
            ];
        });

        $totals = Report::query()->selectRaw('
            sum(revenue) as total_revenue, 
            sum(impressions) as total_impressions, 
            sum(clicks) as total_clicks'
        )
        ->first();

        $totalData = [
            'sum' => $totals->total_revenue,
            'impressions' => $totals->total_impressions,
            'clicks' => $totals->total_clicks,
            'cpm' => $totals->total_impressions > 0 ? number_format(($totals->total_revenue * 1000) / $totals->total_impressions, 2) : 0
        ];

        $data = $reportsByDate->toArray();
        $data['total'] = $totalData;

        return $this->respond(['data' => $data]);
    }
}
