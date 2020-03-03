<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth,
Session;
use App\Notification;
use App\NotificationDetail;
use App\TemplateDetail;

class NotificationsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $aData = array();
        $aData['user_id'] = Auth::user()->id;
        NotificationDetail::where('notify_to', $aData['user_id'])->update(array('seen' => 1));
        $aData['aNotifications'] = Notification::join('notification_details as nd', 'nd.notification_id','notifications.id')
        ->select('notifications.*','nd.notify_to','nd.seen')
        ->where('nd.notify_to',$aData['user_id'])
        ->orderBy('notifications.id','desc')
        ->paginate(15);
        //d($aData,1);
        return view('front.notifications.index', $aData);
    }

    public function show($iId) {
        $aData = array();
        $aData['oNotification'] = Notification::find($iId);
        $aData['oTemplateDetails'] = TemplateDetail::find($aData['oNotification']->type_id);
        if($aData['oNotification']->type == 'new_joiner'){
            return $this->showNewJoiner($aData);
        }
        if($aData['oNotification']->type == 'resignation'){
            return $this->showResignation($aData);
        }
        if($aData['oNotification']->type == 'departure'){
            return $this->showDeparture($aData);
        }
        if($aData['oNotification']->type == 'holiday'){
            return $this->showHoliday($aData);
        }
        if($aData['oNotification']->type == 'security'){
            return $this->showSecurity($aData);
        }
        if($aData['oNotification']->type == 'product_launch'){
            return $this->showProductLaunch($aData);
        }
        if($aData['oNotification']->type == 'event_launch'){
            return $this->showEventLaunch($aData);
        }
        if($aData['oNotification']->type == 'internal_job_posting'){
            return $this->showInternalJobPosting($aData);
        }
        if($aData['oNotification']->type == 'restructuring'){
            return $this->showRestructuring($aData);
        }
        if($aData['oNotification']->type == 'national_or_international_day'){
            return $this->showNationalOrInternationalDay($aData);
        }
        if($aData['oNotification']->type == 'testing'){
            return $this->showTesting($aData);
        }
        
        if($aData['oNotification']->type == 'ntb'){
            return $this->showNewtemplateB($aData);
        }
        if($aData['oNotification']->type == 'ntc'){
            return $this->showNewtemplateC($aData);
        }
        if($aData['oNotification']->type == 'ntd'){
            return $this->showNewtemplateD($aData);
        }
        if($aData['oNotification']->type == 'nte'){
            return $this->showNewtemplateE($aData);
        }
        if($aData['oNotification']->type == 'ntf'){
            return $this->showNewtemplateF($aData);
        }
        if($aData['oNotification']->type == 'ntg'){
            return $this->showNewtemplateG($aData);
        }
        if($aData['oNotification']->type == 'nth'){
            return $this->showNewtemplateH($aData);
        }
    }

    protected function showNewJoiner($aData){
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['name'] = $aGetMeta->name;
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aData['designation'] = $aGetMeta->designation;
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showResignation($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['name'] = $aGetMeta->name;
        $aData['resignationDay'] = $aGetMeta->resignationDay;
        $aData['lastWorkingDay'] = $aGetMeta->lastWorkingDay;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showDeparture($aData){
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['employeeDetails'] = $aGetMeta->employeeDetails;
        $aData['otherDetails'] = $aGetMeta->otherDetails;
        $aData['contactDetails'] = $aGetMeta->contactDetails;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showHoliday($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['location'] = $aGetMeta->location;
        $aData['date'] = $aGetMeta->date;
        $aData['day'] = $aGetMeta->day;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showSecurity($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showProductLaunch($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['productName'] = $aGetMeta->productName;
        $aData['date'] = $aGetMeta->date;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showEventLaunch($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);

    }
    protected function showInternalJobPosting($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['jobPost'] = $aGetMeta->jobPost;
        $aData['area'] = $aGetMeta->area;
        $aData['regards'] = $aGetMeta->regards;
        $aData['image'] = $aGetMeta->image;
        return view('front.notifications.details', $aData);
    }
    protected function showRestructuring($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }

    protected function showNationalOrInternationalDay($aData) {
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }

    protected function showTesting($aData) {
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
    
     protected function showNewtemplateB($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
     protected function showNewtemplateC($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }

protected function showNewtemplateD($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
    protected function showNewtemplateE($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
    protected function showNewtemplateF($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
    protected function showNewtemplateG($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
    protected function showNewtemplateH($aData){
        $aData['file'] = $aData['oTemplateDetails']->file;
        $aGetMeta = json_decode($aData['oTemplateDetails']->meta);
        $aData['description'] = $aData['oTemplateDetails']->description;
        $aData['image'] = $aGetMeta->image;
        $aData['regards'] = $aGetMeta->regards;
        return view('front.notifications.details', $aData);
    }
    public function unseen() {
        $user_id = Auth::user()->id;
        return NotificationDetail::where('notify_to', $user_id)->where('seen', 0)->count();
    }

}
