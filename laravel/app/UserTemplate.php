<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
	public static function getUserTemplate(array $aSearch) {

		$oResult = self::join('templates as t', 't.id', '=', 'user_templates.template_id')
		->select('t.id', 'user_templates.user_id', 't.title');
        //$sQuery = 'select m.id, m.parent_id, m.title, m.path, m.icon, um.user_id from templates as m join user_templates as um on um.module_id = m.id where 1 ';
		if (isset($aSearch['iUserId'])) {
            //$sQuery .= "and um.user_id = $aSearch['iUserId'] ";
			$oResult = $oResult->where('user_templates.user_id', $aSearch['iUserId']);
		}
		if (isset($aSearch['iTemplateId'])) {
            //$sQuery .= "and um.user_id = $aSearch['iUserId'] ";
			$oResult = $oResult->where('t.id', $aSearch['iTemplateId']);
		}
		$oResult = $oResult->orderBy('id','asc')->get();
        //d($oResult, 1);
		return $oResult;
	}
}
