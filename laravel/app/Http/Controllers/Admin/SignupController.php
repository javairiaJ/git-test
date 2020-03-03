<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//use Intervention\Image\Facades\Image as Image;

class SignupController extends AdminController {

    // use AuthenticatesAndRegistersUsers;
    use AuthenticatesUsers;

    protected $loginPath = '/login';

    //public $mailchimp;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
        //parent::__construct();
        $this->middleware('guest', ['except' => 'success', 'except' => 'logout']);
    }

    public function login() {
        return view('admin.login');
    }

    public function postLogin(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)
        ->where('role_id', '!=', 2)
        ->first();

        if (count($user) > 0) {
            if ($user->status != 1) {
                Session::flash('danger', "You can't access your account, Please! contact your administrator");
                return redirect('admin/login')->withInput();
            }
            if ($user->isConfirmed != 1 && $user->status != 1) {
                Session::flash('danger', "You haven't activated your account yet");
                return redirect('admin/login')->withInput();
            }

            if ($this->auth->attempt($credentials, $request->has('remember'))) {

                return redirect('admin');
            }

            return redirect($this->loginPath)
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->sendFailedLoginResponse($request),
            ]);
        } else {
            Session::flash('danger', "User not found");
            return redirect($this->loginPath)->withInput();
        }
    }

    public function logout(Request $request) {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect($this->loginPath);
    }

    protected function guard() {
        return Auth::guard();
    }

}
