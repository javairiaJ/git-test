<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckAdminAuth {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
                if (Auth::check()) {
            if (Auth::user()->role->code != 'user') {
                return $next($request);
            } else {
                echo '<script>alert("You are not authorized for this action");</script>';
                Session::flash('denied','You are not authorized for this action');
                return redirect('/');
            }
        }
        return redirect('/login');
//        if (Auth::guard($guard)->check()) {
//            return redirect('admin/login');
//        }
//
//        return $next($request);
    }

}
