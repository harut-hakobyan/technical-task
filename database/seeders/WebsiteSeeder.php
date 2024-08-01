<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder {

    public function run(): void {
        if (!Website::query()->exists()) {
            Website::factory(120)->create();
        }
    }
}
