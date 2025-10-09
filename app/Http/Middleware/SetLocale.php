<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session, fallback to config default
        $locale = session('locale', config('app.locale'));
        
        // Validate locale
        if (in_array($locale, ['fr', 'ar', 'en'])) {
            app()->setLocale($locale);
        }
        
        return $next($request);
    }
}
