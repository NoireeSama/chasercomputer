<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !$user->role) {
            abort(403, 'Tidak punya role');
        }

        if (!in_array(strtolower($user->role->nama), $roles)) {
            abort(403, 'Anda tidak punya akses ke halaman ini');
        }

        return $next($request);
    }
}
