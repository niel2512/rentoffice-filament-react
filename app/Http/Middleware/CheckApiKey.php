<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY'); // Get the API key from the request header

        // Check if the API key is present and valid
        // If the API key is not present or invalid, return a 401 Unauthorized response
        // If the API key is present, check if it exists in the database
        if (!$apiKey || !ApiKey::where('key', $apiKey)->exists()) { //typo apikey😊 (kurang tanda seru)
            return response()->json(['message!' => 'Unauthorized'], 401);
        }
        
        return $next($request);
    }
}
