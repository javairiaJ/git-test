<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BackLog extends Model {

    public static function createLog($input) {
        // d($input,1);
        $data = array();
        $data['user_id'] = Auth::user()->id;
        $data['name'] = Auth::user()->firstName . ' ' . Auth::user()->lastName;
        $data['eventType'] = $input['eventType'];
        $data['eventDetail'] = $input['eventDetail'];
        $data['eventReason'] = $input['eventReason'];

        //d($data,1);
        self::insert($data);
    }

    public static function searchBackLogs($search) {

        $result = self::
                //join('departments as d', 'd.id', '=', 'shifts.department_id')
                select('back_logs.*');
                //->where("shifts.deleted", '=', 0);

//        if (isset($search['department_id']) && $search['department_id'] != "") {
//            $department_id = $search['department_id'];
//            $result->where("shifts.department_id", '=', $department_id);
//        }

        $result = $result->orderBy('back_logs.id', 'desc')->get();
//        $result = $result->paginate(10);
//        $result->setPath('back_logs');
        return $result;
    }

}
