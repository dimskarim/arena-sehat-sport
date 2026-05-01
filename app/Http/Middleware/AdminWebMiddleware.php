<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminWebMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai Admin terlebih dahulu.');
        }

        return $next($request);
    }
}
