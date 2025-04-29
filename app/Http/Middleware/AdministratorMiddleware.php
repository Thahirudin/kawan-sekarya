<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('pegawai')->check() && in_array(auth()->guard('pegawai')->user()->jabatan, ['Administrator', 'Founder'])) {
            return $next($request);
        }

        return redirect('/login');
    }
}
