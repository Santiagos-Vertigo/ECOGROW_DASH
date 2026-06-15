<?php

namespace App\Jobs;

use App\Models\Telemetry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTelemetry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $device_id;
    public $soil_moisture;
    public $recorded_at;

    public function __construct($device_id, $soil_moisture, $recorded_at)
    {
        $this->device_id = $device_id;
        $this->soil_moisture = $soil_moisture;
        $this->recorded_at = $recorded_at;
    }

    public function handle(): void
    {
        Telemetry::create([
            'device_id' => $this->device_id,
            'soil_moisture' => $this->soil_moisture,
            'recorded_at' => $this->recorded_at,
        ]);
    }
}
