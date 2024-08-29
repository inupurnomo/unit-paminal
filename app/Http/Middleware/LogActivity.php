<?php

namespace App\Http\Middleware;

use App\Helpers\LogActivity as HelpersLogActivity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        HelpersLogActivity::addToLog();
        return $next($request);
    }
}
