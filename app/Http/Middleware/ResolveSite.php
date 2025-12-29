<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->routeIs('site.page')) {
            return $next($request);
        }

        $slug = $request->segment(1);
        
        $site = Site::where('slug', $slug)->first();
        dd($site);
        abort_if(!$site, 404);

        view()->share('site', $site);

        return $next($request);
    }
}
