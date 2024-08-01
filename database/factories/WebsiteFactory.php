<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory {

    public function definition(): array {
        $domain = $this->faker->domainName;
        $url = "https://{$domain}";

        return [
            'url' => $url,
        ];
    }
}
