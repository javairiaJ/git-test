<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Content;
use Config;
use App\Functions\Functions;

class MembershipExpiryReminder extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiry:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Memberships expiry and send reminder to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $getUsers = User::leftjoin('users_memberships as um', 'um.user_id', '=', 'users.id')
                ->leftjoin('memberships as m', 'um.membership_id', '=', 'm.id')
                ->leftjoin('billing_types as bt', 'um.billing_type_id', '=', 'bt.id')
                ->select('users.id', 'users.email', 'users.firstName', 'users.lastName', 'um.type', 'm.title as membershipName', 'bt.title as billingType', 'um.expiryDate')
                ->where("users.status", '=', 1)
                ->where("users.deleted", '=', 0)
                ->where("um.status", '=', 1)
                ->get();
        $daysBefore = 1;
        if (count($getUsers) > 0) {
            foreach ($getUsers as $value) {
                $currentDate = Carbon::now()->format('Y-m-d');
                $date = $value->expiryDate;
                $startDate = new \Carbon\Carbon($date);
                $endDate = $startDate->subDays($daysBefore)->format('Y-m-d');
                if ($currentDate == $endDate) {
                    $content = Content::where('code', '=', 'reminder-membership-expiry')->get();
                    $replaces = array();
                    if (count($content) > 0) {

                        $replaces['name'] = $value->firstName . ' ' . $value->lastName;
                        $replaces['membershipName'] = $value->membershipName;
                        $replaces['billingType'] = '';
                        if ($value->type == 'paid') {
                            $replaces['billingType'] = $value->billingType;
                        }
                        $replaces['daysRemaining'] = $daysBefore . ' day';
                        $replaces['siteName'] = Config::get('params.site_name');
                        $replaces['siteUrl'] = env('APP_URL');
                        $replaces['siteFooter']= Functions::setEmailFooter();

                        $template = Functions::setEmailTemplate($content, $replaces);
                        Functions::sendEmail($value->email, $template['subject'], $template['body']);
                    }
                }
            }
        }
    }

}
