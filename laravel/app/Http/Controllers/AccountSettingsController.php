<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Membership;
use App\MembershipBillingType;
use Auth,
    Session;

//use Carbon\Carbon;
//use App\Content;
//use Config;
//use App\Functions\Functions;

class AccountSettingsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
//        $startDate = \Carbon\Carbon::now()->format('Y-m-d');
//        $endDate = $startDate->addDays($billingType->duration)->format('Y-m-d');
//        $date = Carbon::now()->format('Y-m-d');
//        $startDate = new \Carbon\Carbon($date);
//        $endDate = $startDate->addDays('10')->format('Y-m-d');
        // d($endDate,1);
        //d($getUsers, 1);


        $data = array();
        $user_id = Auth::user()->id;
        $data['user'] = User::findOrFail($user_id);
        Session::put('token', $data['user']->key);
        $data['userMembership'] = User::leftjoin('users_memberships as um', 'um.user_id', '=', 'users.id')
                ->leftjoin('membership_billing_types as mbt', 'um.membership_id', '=', 'mbt.membership_id')
                ->leftjoin('memberships as m', 'um.membership_id', '=', 'm.id')
                ->leftjoin('billing_types as bt', 'um.billing_type_id', '=', 'bt.id')
                ->select('m.id as membership_id', 'm.title as membershipName', 'm.type', 'm.freeDuration', 'bt.title as billingTypeName', 'mbt.price', 'mbt.isFree', 'mbt.freeDays')
                ->where("users.deleted", '=', 0)
                ->where("um.status", '=', 1)
                ->where("users.status", '=', 1)
                ->where("users.id", '=', $user_id)
                ->first();
        //d($data['userMembership'], 1);
        if (count($data['userMembership']) > 0) {
            $data['memberships'] = Membership::where('id', '!=', $data['userMembership']->membership_id)->where('status', 1)->where('deleted', 0)->get();
            $data['membershipBillingTypes'] = MembershipBillingType::join('billing_types as bt', 'bt.id', '=', 'membership_billing_types.billing_type_id')
                    ->select('membership_billing_types.membership_id', 'membership_billing_types.price', 'membership_billing_types.isFree', 'membership_billing_types.freeDays', 'bt.id', 'bt.title', 'bt.code', 'bt.duration')
                    ->where('bt.status', 1)->where('bt.deleted', 0)
                    ->where('membership_billing_types.status', 1)->where('membership_billing_types.deleted', 0)
                    ->get();

            return view('front.account_settings.index', $data);
        } else {
            return redirect('memberships');
        }
    }

}
