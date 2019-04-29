<?php

namespace App\Http\Middleware;
use Closure;

class AdminMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if(!isAdmin()) {
            return redirect()->back()->with('update_error', "You have no privilege to access this content");
        }
        return $next($request);
    }
}
