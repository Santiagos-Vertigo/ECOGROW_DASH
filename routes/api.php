<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelemetryController;

Route::middleware('api.key')->post('/telemetry', [TelemetryController::class, 'store']);
