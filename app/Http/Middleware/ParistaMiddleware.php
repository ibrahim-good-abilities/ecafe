<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class ParistaMiddleware
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
        if ($request->user()!='parista' && $request->user()->role_id != 2)
            {
                 return new Response(view('unauthorized')->with('role', 'PARISTA'));
            }
        return $next($request);
    }
}
