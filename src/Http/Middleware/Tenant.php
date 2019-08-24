<?php

namespace RafaelMorenoJS\MultiTenant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Tenant
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!is_null($user)) {
            $user->dbConfig->connect();
        }

        return $next($request);
    }
}
