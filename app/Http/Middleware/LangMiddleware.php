<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LangMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        $contentLanguage = $request->header('Content-Language');

        if ($contentLanguage) {
            App::setLocale($contentLanguage);
        } else {
            App::setLocale('en');
        }

        $response = $next($request);

        return $response;
    }
}
