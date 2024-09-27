<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestLogMiddleware extends Middleware
{
    public function __construct() {}
    public function handle($request, Closure $next)
    {

        $log = [];

        $log["method"] = $request->method();
        $log["path"] = $request->path();
        $log["query_string"] = $request->query();
        $log["body"] = $request->getContent();

        $log["headers"] = $request->headers->all();

        if (isset($log["headers"]["authorization"])) {
            unset($log["headers"]["authorization"]);
        }

        $log["ip"] = $request->ip();
        $log["user_agent"] = $request->userAgent();

        $response = $next($request);

        $log["res_status_code"] = $response->status();
        $log["res_headers"] = ($response->headers->all());
        $log["res_body"] = $response->getContent();

        Log::info("Request", $log);

        return $response;
    }
}
