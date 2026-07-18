<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !in_array($user->role, ['admin', 'pemilik'])) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthorized. Akses admin atau pemilik diperlukan.',
                'data' => null,
            ], 403);
        }

        return $next($request);
    }
}
