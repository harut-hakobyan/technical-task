<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebsiteController extends Controller {

    public function index(): JsonResponse {
        $websites = Website::query()->paginate(20);

        return response()->json($websites);
    }

    public function show(Website $website): JsonResponse {
        return $this->respond($website);
    }

    public function store(Request $request): JsonResponse {
        $request->validate([
            'url' => 'required|url',
        ]);

        Website::query()->create($request->all());

        return response()->json(['result' => true], 201);
    }

    public function update(Request $request, Website $website): JsonResponse {
        $request->validate([
            'url' => 'required|url',
        ]);

        $website->update($request->all());

        return $this->respond(['result' => true]);
    }

    public function destroy(Website $website): JsonResponse {
            $website->delete();

        return $this->respond(['result' => true], 200);
    }

    public function getWebsiteReport(string $id): JsonResponse {
        if (Website::query()->find($id)) {
            $dailyReports = Report::query()->selectRaw('
                date, sum(revenue) as total_revenue,
                sum(impressions) as total_impressions,
                sum(clicks) as total_clicks'
            )
                ->where('website_id', $id)
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->mapWithKeys(function ($item) {
                    $cpm = $item->total_impressions > 0 ? ($item->total_revenue * 1000) / $item->total_impressions : 0;
                    return [
                        $item->date => [
                            'revenue' => number_format($item->total_revenue, 2),
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
                ->where('website_id', $id)
                ->first();

            $totalRevenue = $totals->total_revenue ?? 0;
            $totalImpressions = $totals->total_impressions ?? 0;
            $totalClicks = $totals->total_clicks ?? 0;
            $totalCpm = $totalImpressions > 0 ? ($totalRevenue * 1000) / $totalImpressions : 0;

            $totalData = [
                'sum' => number_format($totalRevenue, 2),
                'impressions' => $totalImpressions,
                'clicks' => $totalClicks,
                'cpm' => number_format($totalCpm, 2)
            ];

            $data = $dailyReports->toArray();
            $data['total'] = $totalData;

            return $this->respond(['data' => $data]);
        }

        return $this->respond(['result' => false, 'message' => 'Website not found.'], 400);
    }
}
