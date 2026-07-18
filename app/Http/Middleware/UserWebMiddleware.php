<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Admin and Pemilik shouldn't be able to access front-end user pages
        if ($user && in_array($user->role, ['admin', 'pemilik'])) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
