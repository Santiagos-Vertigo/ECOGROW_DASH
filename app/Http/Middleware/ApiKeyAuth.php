<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Device;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');

        if (!$apiKey) {
            return response()->json(['error' => 'API key missing'], 401);
        }

        $device = Device::where('api_key', $apiKey)->first();

        if (!$device) {
            return response()->json(['error' => 'Invalid API key'], 403);
        }

        // Attach device to request context
        $request->attributes->set('device', $device);

        return $next($request);
    }
}
