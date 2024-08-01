<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder {

    public function run(): void {
        if (!Report::query()->exists()) {
            foreach (Website::query()->cursor() as $website) {
                $randomDate = $this->getRandomDate();

                Report::query()->updateOrCreate(
                    ['website_id' => $website->id, 'date' => $randomDate],
                    [
                        'revenue' => rand(0, 1000),
                        'impressions' => rand(100, 10000),
                        'clicks' => rand(0, 1000)
                    ]
                );
            }
        }
    }

    private function getRandomDate() {
        $startDate = Carbon::create(2024, 3, 1);
        $endDate = Carbon::create(2024, 4, 12);
        $startTimestamp = $startDate->timestamp;
        $endTimestamp = $endDate->timestamp;
        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

        return Carbon::createFromTimestamp($randomTimestamp)->format('Y-m-d');
    }
}
