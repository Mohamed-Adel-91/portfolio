<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(auth()->user()) {

            if (Auth::guard('project_manager')->check()) {
                return redirect(route('manager.dashboard'));
            }

            if (Auth::guard('client')->check()) {
                return redirect(route('client.dashboard'));
            }

            if (Auth::guard('content_creator')->check()) {
                return redirect(route('content_creator.dashboard'));
            }

            if (Auth::guard('content_translator')->check()) {
                return redirect(route('content_translator.dashboard'));
            }

        }

        return $next($request);
    }
}
