<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Validator,
    Redirect,
    Session;
use App\Department;
use App\Shift;
use App\BackLog;

class BackLogsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array();
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        if (isset($_GET['shift_id'])) {
            $data['shift_id'] = $_GET['shift_id'];
        }
        $data['page'] = $page;
//        $data['shifts'] = $this->getDepartmentsShifts();
        return view('admin.back_logs.index', $data);
    }

    public function listing(Request $request) {
        // d($request->all(),1);
        $data['search'] = $request->all();
        $data['model'] = BackLog::searchBackLogs($data['search']);
        //d($data['model'],1);
        return view('admin.back_logs.ajax.list', $data);
    }

    public function delete($id) {
        $row = BackLog::where('id', '=', $id)->delete();
        if ($row) {
            Session::flash('success', 'Successfully Deleted');
        } else {
            Session::flash('danger', 'Not Deleted');
        }

        return redirect('admin/back-logs');
    }

}
