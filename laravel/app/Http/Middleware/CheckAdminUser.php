<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckAdminUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            if (Auth::user()->role->code == 'admin' || Auth::user()->role->code == 'admin_user' || Auth::user()->role->code == 'hr') {
                return $next($request);
            } else {
                echo '<script>alert("You are not authorized for this action");</script>';
                Session::flash('denied', 'You are not authorized for this action');
                return redirect('/');
            }
        }
        return redirect('/login');
    }

}
