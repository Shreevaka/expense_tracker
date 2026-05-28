<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectHomeIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && $request->is('/')) {

            return auth()->user()->hasRole('admin')
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}
