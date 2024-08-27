<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAccess
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, $role): Response
  {

    $user = Auth::user();

    if ($user->role_name() != $role) {
      // Jika pengguna tidak memiliki peran yang diperlukan, tampilkan halaman 403 Forbidden
      abort(403, 'Anda tidak memiliki akses untuk halaman ini.');
    }

    return $next($request);
  }
}
