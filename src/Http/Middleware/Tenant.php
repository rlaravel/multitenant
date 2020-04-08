<?php

namespace RLaravel\MultiTenant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class Tenant
 * @package RLaravel\MultiTenant\Http\Middleware
 */
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
