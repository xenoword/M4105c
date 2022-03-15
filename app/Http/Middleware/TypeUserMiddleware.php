<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TypeUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$idTypeUserList)
    {
        
        if (!in_array($request->user()->type_user_id, $idTypeUserList)) {
            abort(401);
        }
        return $next($request);
    }
}
