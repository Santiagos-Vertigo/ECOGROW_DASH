<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('telemetries', function (Blueprint $table) {
            $table->id();

            // Proper foreign key relationship to devices table
            $table->foreignId('device_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Flexible metrics storage (supports multiple sensors)
            $table->json('metrics');

            // Time-series field (critical for IoT)
            $table->timestamp('recorded_at');

            $table->timestamps();

            // Performance index (VERY important)
            $table->index(['device_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telemetries');
    }
};
