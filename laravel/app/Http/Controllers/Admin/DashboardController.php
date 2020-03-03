<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\User;
use App\Module;

class DashboardController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $aData = array();

        $aData['iTotalUsers'] = User::where('role_id', '!=', 1)->count();
        $aData['iTotalModules'] = Module::where('parent_id', 0)->where('status', 1)->count();
        $aData['aRecentUsers'] = User::where('role_id', '!=', 1)->orderBy('id', 'desc')->limit(7)->get();


        return view('admin.dashboard', $aData);
    }

}
