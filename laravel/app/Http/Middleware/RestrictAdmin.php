<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RestrictAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            if (Auth::user()->role->code == 'admin') {
                return redirect('admin');
            }
        }
        return $next($request);
    }

}
