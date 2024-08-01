<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory {

    public function definition(): array {
        return [
            'website_id' => Website::query()->inRandomOrder()->first()->id,
            'revenue' => $this->faker->numberBetween(100, 1000),
            'impressions' => $this->faker->numberBetween(100, 10000),
            'clicks' => $this->faker->numberBetween(0, 1000),
            'date' => $this->faker->date('Y-m-d', '2024-04-12'),
        ];
    }
}
