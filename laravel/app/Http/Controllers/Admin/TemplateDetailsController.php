<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Templates\TemplatesStoreRequest;
use App\Http\Requests\Templates\TemplatesUpdateRequest;
use Auth;
use App\Template;
use App\TemplateDetail;
use DB;
use Session;
use App\Functions\Functions;
use Intervention\Image\Facades\Image as Image;
use App\User;
use App\Functions\UsersNotifications;

class TemplateDetailsController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   // private $aTemplateTypes;

    public function __construct() {
        parent::__construct();
    }

    public function saveTemplateDetails(Request $request, $code) {
        $response = '';
        $aParams = $request->except('_token');
        //d($aParams,1);
        DB::beginTransaction();
        try {
            if($code == 'new_joiner'){
                $response = $this->saveNewJoiner($aParams, $code);
            }
            if($code == 'resignation'){
                $response = $this->saveResignation($aParams, $code);
            }
            if($code == 'departure'){
                $response = $this->saveDeparture($aParams, $code);
            }
            if($code == 'holiday'){
                $response = $this->saveHoliday($aParams, $code);
            }
            if($code == 'security'){
                $response = $this->saveSecurity($aParams, $code);
            }
            if($code == 'product_launch'){
                $response = $this->saveProductLaunch($aParams, $code);
            }
            if($code == 'event_launch'){
                $response = $this->saveEventLaunch($aParams, $code);
            }
            if($code == 'internal_job_posting'){
                $response = $this->saveInternalJobPosting($aParams, $code);
            }
            if($code == 'restructuring'){
                $response = $this->saveRestructuring($aParams, $code);
            }
            if($code == 'national_or_international_day'){
                $response = $this->saveNationalOrInternationalDay($aParams, $code);
            }
            if($code == 'testing'){
                $response = $this->saveTesting($aParams, $code);
            }
            
            if($code == 'ntb'){
                $response = $this->saveNewtemplateB($aParams, $code);
            }
            if($code == 'ntc'){
                $response = $this->saveNewtemplateC($aParams, $code);
            }
            if($code == 'ntd'){
                $response = $this->saveNewtemplateD($aParams, $code);
            }
            if($code == 'nte'){
                $response = $this->saveNewtemplateE($aParams, $code);
            }
            if($code == 'ntf'){
                $response = $this->saveNewtemplateF($aParams, $code);
            }
            if($code == 'ntg'){
                $response = $this->saveNewtemplateG($aParams, $code);
            }
            if($code == 'nth'){
                $response = $this->saveNewtemplateH($aParams, $code);
            }
            if(isset($response['error']) && $response['error'] == 0){
                DB::commit();
                Session::flash('success', 'Succsessfully Submitted!');
                return redirect()->back();
            } else {
                throw new \Exception("Error Processing Request", 1);
            }
        } catch (\Exception $ex) {
            Session::flash('danger', $ex->getMessage());
            return redirect()->back();
        }
    }

    protected function saveNewJoiner($aParams, $code){
        //d($aParams,1);
     $input = array();
     $response = array();
     $response['error'] = 0;
     try {
         $input['file'] = null;
         if (!empty($aParams['file'])) {
            $file = $aParams['file'];
            $destinationPath = public_path() . '/uploads/notifications/';
            $fileName = Functions::saveImage($file, $destinationPath);
            $input['file'] = $fileName;
        }
        $aMeta = array();
        $aMeta['name'] = $aParams['name'];
        $aMeta['designation'] = $aParams['designation'];
        $aMeta['regards'] = $aParams['regards'];
        $input['meta'] = json_encode($aMeta);
        $input['description'] = $aParams['description'];
        $input['template_id'] = $aParams['template_id'];
        //d($input,1);
        $lastInsertedId = TemplateDetail::insertGetId($input);

        $oTemplateDetails = TemplateDetail::find($lastInsertedId);

        $oTemplate = Template::find($oTemplateDetails->template_id);

        $aNotification = array();
        $aGetMeta = json_decode($oTemplateDetails->meta);
        $aNotification['name'] = $aGetMeta->name;
        $aNotification['file'] = $oTemplateDetails->file;
        $aNotification['designation'] = $aGetMeta->designation;
        $aNotification['regards'] = $aGetMeta->regards;
        $aNotification['description'] = $oTemplateDetails->description;

        $aNotification['type'] = $code;
        $aNotification['type_id'] = $lastInsertedId;
        $aNotification['templateTitle'] = $oTemplate->title;
        $aNotification['from_email'] = $aParams['from_email'];
        $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:''; 

        UsersNotifications::save($aNotification);

    } catch (\Exception $ex) {
        d($ex->getMessage(),1);
     $response['error'] = 1;
 }
 return $response;
}


protected function saveResignation($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
     $input['file'] = null;
     if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $aMeta = array();
    $aMeta['name'] = $aParams['name'];
    $aMeta['resignationDay'] = $aParams['resignationDay'];
    $aMeta['lastWorkingDay'] = $aParams['lastWorkingDay'];
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['name'] = $aGetMeta->name;
    $aNotification['resignationDay'] = $aGetMeta->resignationDay;
    $aNotification['lastWorkingDay'] = $aGetMeta->lastWorkingDay;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveDeparture($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {

        $aMeta = array();
        $aMeta['employeeDetails'] = $aParams['employeeDetails'];
        $aMeta['otherDetails'] = $aParams['otherDetails'];
        $aMeta['contactDetails'] = $aParams['contactDetails'];
        $aMeta['regards'] = $aParams['regards'];
        $input['meta'] = json_encode($aMeta);
        $input['template_id'] = $aParams['template_id'];

        $lastInsertedId = TemplateDetail::insertGetId($input);

        $oTemplateDetails = TemplateDetail::find($lastInsertedId);

        $oTemplate = Template::find($oTemplateDetails->template_id);

        $aNotification = array();
        $aGetMeta = json_decode($oTemplateDetails->meta);
        $aNotification['employeeDetails'] = $aGetMeta->employeeDetails;
        $aNotification['otherDetails'] = $aGetMeta->otherDetails;
        $aNotification['contactDetails'] = $aGetMeta->contactDetails;
        $aNotification['regards'] = $aGetMeta->regards;

        $aNotification['type'] = $code;
        $aNotification['type_id'] = $lastInsertedId;
        $aNotification['templateTitle'] = $oTemplate->title;
        $aNotification['from_email'] = $aParams['from_email'];
        $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
        UsersNotifications::save($aNotification);

    } catch (\Exception $ex) {
     $response['error'] = 1;
 }
 return $response;
}

protected function saveHoliday($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
     $input['file'] = null;
     if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $aMeta = array();
    $aMeta['location'] = $aParams['location'];
    $aMeta['date'] = $aParams['date'];
    $aMeta['day'] = $aParams['day'];
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['location'] = $aGetMeta->location;
    $aNotification['date'] = $aGetMeta->date;
    $aNotification['day'] = $aGetMeta->day;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['file'] = $oTemplateDetails->file;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveSecurity($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {

        $aMeta = array();
        $aMeta['regards'] = $aParams['regards'];
        $input['meta'] = json_encode($aMeta);
        $input['description'] = $aParams['description'];
        $input['template_id'] = $aParams['template_id'];

        $lastInsertedId = TemplateDetail::insertGetId($input);

        $oTemplateDetails = TemplateDetail::find($lastInsertedId);

        $oTemplate = Template::find($oTemplateDetails->template_id);

        $aNotification = array();
        $aGetMeta = json_decode($oTemplateDetails->meta);
        $aNotification['regards'] = $aGetMeta->regards;
        $aNotification['description'] = $oTemplateDetails->description;

        $aNotification['type'] = $code;
        $aNotification['type_id'] = $lastInsertedId;
        $aNotification['templateTitle'] = $oTemplate->title;
        $aNotification['from_email'] = $aParams['from_email'];
        $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
        UsersNotifications::save($aNotification);

    } catch (\Exception $ex) {
     $response['error'] = 1;
 }
 return $response;
}


protected function saveProductLaunch($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $aMeta = array();
    $aMeta['productName'] = $aParams['productName'];
    $aMeta['date'] = $aParams['date'];
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['productName'] = $aGetMeta->productName;
    $aNotification['date'] = $aGetMeta->date;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['file'] = $oTemplateDetails->file;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
   $response['error'] = 1;
}
return $response;
}

protected function saveEventLaunch($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
     $input['file'] = null;
     if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['description'] = $oTemplateDetails->description;
    
    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveInternalJobPosting($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
     $input['file'] = null;
     if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['jobPost'] = $aParams['jobPost'];
    $aMeta['area'] = $aParams['area'];
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['jobPost'] = $aGetMeta->jobPost;
    $aNotification['area'] = $aGetMeta->area;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['description'] = $oTemplateDetails->description;
    
    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveRestructuring($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveTesting($aParams, $code){
    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
     $input['file'] = null;
     if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $aMeta = array();
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['description'] = $aParams['description'];
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;
    $aNotification['file'] = $oTemplateDetails->file;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveNationalOrInternationalDay($aParams, $code){
    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
     $input['file'] = null;
     if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $aMeta = array();
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['description'] = $aParams['description'];
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;
    $aNotification['file'] = $oTemplateDetails->file;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}







protected function saveNewtemplateB($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

     $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}






protected function saveNewtemplateC($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

protected function saveNewtemplateD($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}



protected function saveNewtemplateE($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}
protected function saveNewtemplateF($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}
protected function saveNewtemplateG($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}
protected function saveNewtemplateH($aParams, $code){

    $input = array();
    $response = array();
    $response['error'] = 0;
    try {
       $input['file'] = null;
       if (!empty($aParams['file'])) {
        $file = $aParams['file'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $fileName = Functions::saveImage($file, $destinationPath);
        $input['file'] = $fileName;
    }
    $input['description'] = $aParams['description'];
    $aMeta = array();
    $aMeta['image'] = null;
    if (!empty($aParams['image'])) {
        $image = $aParams['image'];
        $destinationPath = public_path() . '/uploads/notifications/';
        $imageName = Functions::saveImage($image, $destinationPath);
        $aMeta['image'] = $imageName;
    }
    $aMeta['regards'] = $aParams['regards'];
    $input['meta'] = json_encode($aMeta);
    $input['template_id'] = $aParams['template_id'];

    $lastInsertedId = TemplateDetail::insertGetId($input);

    $oTemplateDetails = TemplateDetail::find($lastInsertedId);

    $oTemplate = Template::find($oTemplateDetails->template_id);

    $aNotification = array();
    $aGetMeta = json_decode($oTemplateDetails->meta);
    $aNotification['image'] = $aGetMeta->image;
    $aNotification['file'] = $oTemplateDetails->file;
    $aNotification['regards'] = $aGetMeta->regards;
    $aNotification['description'] = $oTemplateDetails->description;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;

    $aNotification['type'] = $code;
    $aNotification['type_id'] = $lastInsertedId;
    $aNotification['templateTitle'] = $oTemplate->title;
    $aNotification['from_email'] = $aParams['from_email'];
    $aNotification['emails'] = !empty($aParams['emails'])?$aParams['emails']:'';
        //
        //d($aNotification,1);
    UsersNotifications::save($aNotification);

} catch (\Exception $ex) {
 $response['error'] = 1;
}
return $response;
}

}
