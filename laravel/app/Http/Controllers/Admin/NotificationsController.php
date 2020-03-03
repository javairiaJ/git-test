<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Templates\TemplatesStoreRequest;
use App\Http\Requests\Templates\TemplatesUpdateRequest;
use App\Http\Requests\Templates\TemplatesAssignUserRequest;
use Auth;
use App\Notification;
use App\NotificationDetail;
use DB;
use Session;
use App\Functions\Functions;
use App\User;
use App\Role;

class NotificationsController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   // private $aTemplateTypes;

    public function __construct() {
        parent::__construct();
        //$this->aTemplateTypes = config('constants.Template_types');
    }

    public function index() {
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        } else {
            $iPage = 1;
        }
        if (isset($_GET['title'])) {
            $aData['title'] = $_GET['title'];
        }
        // if (isset($_GET['status'])) {
        //     $aData['iStatus'] = $_GET['status'];
        // }
        $aData['iPage'] = $iPage;
        return view('admin.notifications.index', $aData);
    }

    public function listing(Request $request) {
        $aData['aSearch'] = $request->all();
        $aData['oModel'] = Notification::searchNotification($aData['aSearch']);
        return view('admin.notifications.ajax.list', $aData);
    }

    public function show($iId) {
        $aData = array();
        $aData['oTemplate'] = Template::find($iId);
        return view('admin.templates.details', $aData);
    }

    public function delete($iId) {
        DB::beginTransaction();
        try {
            Notification::where('id', '=', $iId)->delete();
            NotificationDetail::where('notification_id', '=', $iId)->delete();
            DB::commit();
            Session::flash('success', 'Successfully Deleted!');
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }

    
}
