<?php

use App\Models\Website;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Website::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('revenue');
            $table->integer('impressions');
            $table->integer('clicks');
            $table->date('date');
            $table->timestamps();

            $table->unique(['website_id', 'date']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('reports');
    }
};
