<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class WorkingHoursMiddleware
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
        if (($request->user()->startTime != null ) && date('H:i:s') >= date('H:i:s',strtotime($request->user()->startTime)) && date('H:i:s') >= date('H:i:s',strtotime($request->user()->endTime)) )
            {

                return new Response(view('workingHours'));
            }
        return $next($request);
    }
}
