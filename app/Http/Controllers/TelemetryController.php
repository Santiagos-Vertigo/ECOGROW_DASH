<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessTelemetry;
use Carbon\Carbon;

class TelemetryController extends Controller
{
    public function store(Request $request)
    {
        $device = $request->attributes->get('device');

        $data = $request->validate([
            'soil_moisture' => 'required|numeric',
            'timestamp' => 'required'
        ]);

        // Normalize timestamp
        $recordedAt = Carbon::parse($data['timestamp'])->toDateTimeString();

        // 🚀 SEND TO QUEUE (NOT DB)
        ProcessTelemetry::dispatch(
            $device->device_id,
            $data['soil_moisture'],
            $recordedAt
        );

        return response()->json([
            'status' => 'queued'
        ]);
    }
}
