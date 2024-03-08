<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        // echo $currentUser;

        if ($currentUser->role != 'admin') {
            return response()->json([
                'message' => 'You are not authorized to access this resource',
            ])->setStatusCode(403, 'Unauthorized Action');
        }

        // dd($currentUser);
        return $next($request);
    }
}
