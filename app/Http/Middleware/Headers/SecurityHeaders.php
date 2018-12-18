<?php

namespace App\Http\Middleware\Headers;

use Closure;

class SecurityHeaders
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
            'Referrer-Policy' => 'no-referrer-when-downgrade',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
            'Strict-Transport-Security'=>'max-age:31536000; includeSubDomains',
//            'Content-Security-Policy' => "style-src 'self'"
        ];


        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}
