<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

class CacheMiddleware extends Middleware
{
    private $timeSeconds = 600;

    public function handle($request, Closure $next)
    {
        $cacheKey = 'cache:' . md5($request->fullUrl());

        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        $response = $next($request);

        Cache::put($cacheKey, json_decode($response->getContent()), now()->addSeconds($this->timeSeconds));

        return $response;
    }
}
