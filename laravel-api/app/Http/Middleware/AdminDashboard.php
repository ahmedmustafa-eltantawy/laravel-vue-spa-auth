<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\Api\ApiResponseGenrator;

class AdminDashboard
{
    use ApiResponseGenrator;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if( ! $request->user()->hasRole( 'admin' ) ){
            return $this->resposne([], 401);
        }

        return $next($request);
    }
}
