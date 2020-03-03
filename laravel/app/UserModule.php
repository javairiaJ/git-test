<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use DB;

class UserModule extends Model {

    //
    public static function getUserModule(array $aSearch) {

        $oResult = self::join('modules as m', 'm.id', '=', 'user_modules.module_id')
                ->select('m.id', 'user_modules.user_id');
        //$sQuery = 'select m.id, m.parent_id, m.title, m.path, m.icon, um.user_id from modules as m join user_modules as um on um.module_id = m.id where 1 ';
        if (isset($aSearch['iUserId'])) {
            //$sQuery .= "and um.user_id = $aSearch['iUserId'] ";
            $oResult = $oResult->where('user_modules.user_id', $aSearch['iUserId']);
        }
        $oResult = $oResult->orderBy('id','asc')->get();
        //d($oResult, 1);
        return $oResult;
    }

}
