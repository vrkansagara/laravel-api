<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BeforeAnyDbQueryMiddleware
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
        if (App::environment('local')) {
            // The environment is local
            DB::enableQueryLog();
        }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Store or dump the log data...
//        dd(
//            DB::getQueryLog()
//        );
    }

}
