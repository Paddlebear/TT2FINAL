<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // retrieve selected language from the language cookie
        $lang = $request->cookie('language');
        if (!empty($lang)) {
            App::setLocale($lang);
        }        
        return $next($request);
    }
}
