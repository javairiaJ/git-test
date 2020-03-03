<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\User;
use Auth,
    Validator,
    Session;
use Hash;

class PasswordController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
    }

    public function changePasswordForm() {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return view('admin.password.change_password')->with('user_id', $user_id);
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
            Session::flash('success', 'Your password has been updated');
            return redirect()->back();
        }
    }

}
