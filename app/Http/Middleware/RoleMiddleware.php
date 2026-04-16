<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
public function handle(Request $request, Closure $next, $role)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    if (!Auth::user()->role) {
        abort(403, 'No role assigned');
    }

  if (!Auth::user()->role || strtolower(Auth::user()->role) !== strtolower($role)) {
    return redirect('/login')->with('error', 'Unauthorized access');
}

    return $next($request);
}
}