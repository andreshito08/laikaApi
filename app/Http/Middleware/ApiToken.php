<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('api-key-laika');
        if ($key !="p2lbgWkFrykA4QyUmp4s5ytcdfHihzmc5BNzIABqq23") {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
