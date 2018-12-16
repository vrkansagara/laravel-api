<?php

namespace App\Http\Middleware\Headers;

use Closure;

/**
 *
 * Class RemoveUnwantedHeaders
 * @package App\Http\Middleware
 */
class RemoveUnwantedHeaders
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

        $headers = [
            'Server' => 'nginx',
//            'X-Powered-By' => 'vrkansagara'
        ];

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;

    }
}
