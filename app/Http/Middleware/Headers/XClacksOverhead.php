<?php

namespace App\Http\Middleware\Headers;

use Closure;


/**
 *
 * X-Clacks-Overhead
 *
 * @url https://xclacksoverhead.org/home/about
 *
 * Class XClacksOverhead
 * @package App\Http\Middleware
 */
class XClacksOverhead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        $response->header('x-clacks-overhead', 'GNU Terry Pratchett');
        return $response;

    }
}
