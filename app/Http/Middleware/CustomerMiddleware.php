<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()&& $request->user()->role_id != 4)
        {
             return new Response(view('unauthorized')->with('role', 'CUSTOMER'));
        }
        return $next($request);
    }
}
