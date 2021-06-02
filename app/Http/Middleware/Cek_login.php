<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($role == 'admin' && auth()->user()->roles != 0) {
            # code...
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }
        if ($role == 'user' && auth()->user()->roles != 1) {
            # code...
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }
        return $next($request);
    }
}
