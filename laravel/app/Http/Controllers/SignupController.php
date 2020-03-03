<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\Address;
use App\Functions\Functions;
use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
//use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Content;
use Config;
use App\Department;
use App\Shift;
use App\UsersShift;

//use Intervention\Image\Facades\Image as Image;

class SignupController extends Controller {

    // use AuthenticatesAndRegistersUsers;
    use AuthenticatesUsers;

    protected $loginPath = 'login';

    //public $mailchimp;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
        //$this->registrar = $registrar;
        //$this->listId = env('MAILCHIMP_LIST_ID');
        $this->middleware('guest', ['except' => 'success']);
        // $this->mailchimp = $mailchimp;
    }

    public function login() {
        return view('front.users.login');
    }

    public function register() {
        return view('front.users.register');
    }

    public function forgot_password() {
        return view('front.users.forgot');
    }

    public function postLogin(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)
        //->where('role_id', '!=', 1)
        ->first();
        if (count($user) > 0) {
            if ($user->status != 1) {
                Session::flash('danger', "You can't access your account, Please! contact your administrator");
                return redirect('login')->withInput();
            }
            if ($user->isConfirmed != 1 && $user->status != 1) {
                Session::flash('danger', "You haven't activated your account yet");
                return redirect('login')->withInput();
            }

            if ($this->auth->attempt($credentials, $request->has('remember'))) {
                return redirect('dashboard');
                //return redirect()->intended('home');
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

    public function store(Request $request) {

        $validation = array(
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|min:6',
            // 'shift_id' => 'required',
            // 'emp_id' => 'required|unique:users',
        );
        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $register = $request->all();
                array_forget($register, '_token');
                array_forget($register, 'password_confirmation');

                $confirmation_code = Session::get('token');

                $user = new User();
                $user->firstName = $request->firstName;
                $user->lastName = $request->lastName;
                $user->email = $request->email;
                $user->role_id = 2;
                $user->emp_id = $request->emp_id;
                $user->password = bcrypt($request->password);
                $user->key = $confirmation_code;
                $user->isConfirmed = 1;
                $user->save();
                $user_id = $user->id;

                // $afterCreateUser['user_id'] = $user_id;
                // $afterCreateUser['emp_id'] = $request->emp_id;
                // $afterCreateUser['shift_id'] = $request->shift_id;
                // UsersShift::insert($afterCreateUser);

                Address::create(['user_id' => $user_id]);
                //Email sent to verify email address
//                $content = Content::where('code', '=', 'an-authentication-email')->get();
//                $replaces = array();
//                $replaces['name'] = $user->firstName . ' ' . $user->lastName;
//                $replaces['confirmationCode'] = $confirmation_code;
//                $replaces['siteName'] = Config::get('params.site_name');
//                $replaces['siteUrl'] = env('APP_URL');
//                $replaces['siteFooter'] = Functions::setEmailFooter();
//
//                $template = Functions::setEmailTemplate($content, $replaces);
//                Functions::sendEmail($user->email, $template['subject'], $template['body']);
//                $subject = view('emails.confirm_email.subject');
//                $body = view('emails.confirm_email.body', compact('confirmation_code'));
//                Functions::sendEmail($request->email, $subject, $body);
                DB::commit();

                Session::flash('success', 'Thanks for signing up!');
                //Session::flash('success', 'Thanks for signing up! Please check your email to activate your account.');
                //Session::forget('token');
                return redirect()->back();
                //return redirect('checkout');
            } catch (Exception $ex) {
                DB::rollBack();
                $validator->errors()->add('error_db', 'Somthing went wrong try again');
                return redirect()->back();
            }
        }
    }

    public function confirmEmail($confirmation_code) {
        if (!$confirmation_code) {
            return 'Error! Confirmation Key missing.';
        }

        //$token = Session::get('token');
        // if (isset($token) && $token === $confirmation_code) {
        $user = User::where('key', $confirmation_code)->where('isConfirmed', 0)->where('status', 1)->first();
        if (!$user) {
            return 'Whoops! Something went wrong, invalid user';
        } else {
            $user->isConfirmed = 1;
            $user->save();

////        //When new user confirmed registeration
//            $content = Content::where('code', '=', 'welcome-email')->get();
//            $replaces = array();
//            $replaces['name'] = $user->firstName . ' ' . $user->lastName;
//            $replaces['siteName'] = Config::get('params.site_name');
//            $replaces['siteUrl'] = env('APP_URL');
//
//            $template = Functions::setEmailTemplate($content, $replaces);
//            Functions::sendEmail($user->email, $template['subject'], $template['body']);
//        $subjectRegister = view('emails.user_register.subject');
//        $bodyRegister = view('emails.user_register.body', compact('categories'));
//        Functions::sendEmail($user->email, $subjectRegister, $bodyRegister);

            return redirect('register/success/' . $user->key);
        }
        // } else {
        //     header('HTTP/1.0 403 Forbidden');
        //     die("Access Forbidden");
        // }
    }

    public function success($key) {
        $this->middleware('auth');
        $user = User::where('key', $key)->where('status', 1)->first();
        $data['user'] = $user;

        // d($data,1);
        return view('front.users.set_password', $data);
    }

    public function setPassword(Request $request) {
        $input = $request->all();
        $validation = array(
            'password' => 'required|confirmed|min:6',
        );

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::where("id", $request->id)->where("isConfirmed", 1)->where("status", "1")->first();
        if (count($user) == 1) {

            unset($input['_token']);
            unset($input['password_confirmation']);

            $input['password'] = bcrypt($request->password);
            User::where('id', '=', $user->id)->update($input);

//            $body = view("emails.password_email", $replaces);
//            $mail = Functions::sendEmail($user->email, "Your new password.", $body);
            \Session::flash('success', 'Your password added successfully');
            return redirect('/');
        } else {
            \Session::flash('danger', 'Invalid User');
            return redirect()->back();
        }
    }

//
//    public function success($id) {
//        $this->middleware('auth');
//        $user = User::findOrFail($id);
//        $data['user'] = $user;
//        Session::put('token', $user->key);
//        return view('front.users.register_success', $data);
//    }


public function logout(Request $request) {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('login');
    }

    protected function guard() {
        return Auth::guard();
    }


}
