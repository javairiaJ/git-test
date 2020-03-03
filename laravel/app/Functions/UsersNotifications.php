<?php

namespace App\Functions;

use App\Notification;
use Auth;
use App\NotificationDetail;
use App\Functions\Functions;
use App\User;
use App\Template;
use App\Email;
use App\EmailTemplate;
use App\EmailConfiguration;
use Mail;
use Config;

class UsersNotifications {

    public static function save($aNotification) {
        d($aNotification);
        $aData = array();
        $aData['type'] = $aNotification['type'];
        $aData['type_id'] = $aNotification['type_id'];        

        if (!isset($aNotification['user_id'])) {
            $aData['user_id'] = Auth::user()->id;
            $aData['name'] = Auth::user()->firstName . ' ' . Auth::user()->lastName;
            $aData['image'] = Auth::user()->image;
        } else {
            $aData['user_id'] = $aNotification['user_id'];
        }

        $aData['created_at'] = date('Y-m-d H:i:s');

        $aData['description'] = addslashes(view('admin.notifications.' . $aData['type'] .'.subject', compact('aData', 'aNotification')));
        unset($aData['name']);
        unset($aData['image']);
        $iLastInsertedId = Notification::insertGetId($aData);
        $aData['notification_id'] = $iLastInsertedId;
       // d($aData,1);

        $aUsers = User::where('id','!=',$aData['user_id'])->where('deleted', 0)->where('status', 1)->get();
        
        foreach ($aUsers as $user) {
            $aInputNotiDetails['notify_to'] = $user->id;
            $aInputNotiDetails['notification_id'] = $iLastInsertedId;
            NotificationDetail::insertGetId($aInputNotiDetails);
        }

        $oTemplate = Template::where('code',$aData['type'])->first();


        //Override Email Configurations
        if(isset($aNotification['from_email']) && !empty($aNotification['from_email'])){
            $aEmailConfigurations = EmailConfiguration::where('id',$aNotification['from_email'])->first();
            if(!empty($aEmailConfigurations)){
                d($aEmailConfigurations);
                self::overrideMailerConfig([
                    'driver' => $aEmailConfigurations->driver,
                    'host' => $aEmailConfigurations->host,
                    'port' => $aEmailConfigurations->port,
                    'username' => $aEmailConfigurations->username,
                    'password' => $aEmailConfigurations->password,
                    'encryption' => $aEmailConfigurations->encryption,
                    'from_name' => $aEmailConfigurations->from_name
                ]);
            }
        }

        if(!empty($aNotification['emails'])){
            $aEmails = Email::whereIn('id',$aNotification['emails'])->get();
            if(!empty($aEmails)){
                foreach ($aEmails as $row) {
                    //d($row->email,1);
                    $subject = view('emails.notifications.'.$aData['type'].'.subject');
                    $body = view('emails.notifications.'.$aData['type'].'.body', $aNotification);
                    Functions::sendEmail($row->email, $subject, $body);
                }
            }
        }
    }
    public static function overrideMailerConfig($configs){
//d($configs);
       Config::set('mail.driver','log');
       Config::set('mail.host',$configs['host']);
       Config::set('mail.port',$configs['port']);
       Config::set('mail.username',$configs['username']);
       Config::set('mail.password',$configs['password']);
       Config::set('mail.encryption',$configs['encryption']);
       Config::set('mail.from',array('address' => $configs['username'], 'name' => $configs['from_name']));
       Config::set('mail.sendmail','/usr/sbin/sendmail -bs');

       $transport = new \Swift_SmtpTransport($configs['host'], $configs['port']);
       $transport->setUsername($configs['username']);
       $transport->setPassword($configs['password']);
       $transport->setEncryption($configs['encryption']);

// extra configurations here if needed

       $swift_mailer = new \Swift_Mailer($transport);
       $mailer = Mail::setSwiftMailer($swift_mailer);
     //return $mailer;
       d($transport);

       return $mailer;
   }

}
