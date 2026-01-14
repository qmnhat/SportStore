<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::guard('admin')->user();

        if (!$user || $user->VaiTro != $role) {
            abort(403);
        }

        return $next($request);
    }
}
