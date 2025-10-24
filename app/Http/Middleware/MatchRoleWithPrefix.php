<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchRoleWithPrefix
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Ambil prefix pertama dari URL
        $segment = $request->segment(2); // contoh: dashboard/admin → ambil "admin"

        // Cek kalau role tidak sama dengan prefix
        if ($segment && $segment !== $user->role) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
