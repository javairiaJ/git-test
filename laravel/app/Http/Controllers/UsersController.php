<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Address;
use Auth,
    Validator,
    Redirect,
    Session;
use Hash;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function dashboard() {
        //return redirect('monthly-logs');

        $data = array();

        $data['totalUsers'] = User::where('role_id', '!=', 1)->count();
        $data['recentUsers'] = User::where('role_id', '!=', 1)->orderBy('id', 'desc')->limit(7)->get();
        return view('front.users.dashboard', $data);
    }

    public function profile() {
        $data = array();
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        //$address = Address::where('user_id', '=', $user_id)->first();

        $data['user'] = $user;
        //$data['address'] = $address;
        return view('front.users.profile', $data)->with('user_id', $user_id);
    }

    public function editProfile() {
        $data = array();
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        //$address = Address::where('user_id', '=', $user_id)->first();

        $data['user'] = $user;
        //$data['address'] = $address;
        return view('front.users.edit_profile', $data)->with('user_id', $user_id);
    }

    public function updateprofile(Request $request) {

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $input = $request->all();
        $rules = array(
            'firstName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'email' => 'required|min:6|email|unique:users,email,' . $user->id,
                //'emp_id' => 'required|unique:users,emp_id,' . $user->id
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'register')->withInput();
        } else {
            $user = User::findOrFail($user_id);

            unset($input['_token']);
            User::where('id', '=', $user_id)->update($input);
            Session::flash('success', 'Successfully updated');
//            $affectedRows = Address::where('id', '=', $request->address_id)->update($address);

            return redirect('profile');
        }
    }

    public function changePasswordForm() {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return view('front.users.change_password')->with('user_id', $user_id);
    }

    public function updatePassword(Request $request) {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        if (!(Hash::check($request->currentPassword, $user->password))) {
            // The passwords matches
            Session::flash('danger', "Your current password does not matches with the password you provided. Please try again.");
            return redirect()->back();
        }
        if (strcmp($request->currentPassword, $request->password) == 0) {
            //Current password and new password are same
            Session::flash('danger', "New Password cannot be same as your current password. Please choose a different password.");
            return redirect()->back();
        }

        $rules = array(
            'currentPassword' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $data = $request->all();
            array_forget($data, 'password_confirmation');
            array_forget($data, 'currentPassword');
            array_forget($data, '_token');
            $data['password'] = bcrypt($request->password);
            $user->update($data);
            Session::flash('success', 'Successfully updated');
            return redirect()->back();
        }
    }

}
