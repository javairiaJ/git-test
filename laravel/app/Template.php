<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserTemplate;

class Template extends Model
{
    //
	public static function searchTemplate($aSearch) {

		// $result = self::select('templates.*')
		// ->where("templates.deleted", '=', 0);
		$oResult = UserTemplate::rightJoin('templates as t', 't.id', '=', 'user_templates.template_id')
		->select('t.*', 'user_templates.user_id');

		if (isset($aSearch['status']) && $aSearch['status'] != "") {
			$status = $aSearch['status'];
			$oResult->where("t.status", '=', $status);
		}

		if (isset($aSearch['title']) && $aSearch['title'] != "") {
			$title = $aSearch['title'];
			$oResult = $oResult->where('title', 'LIKE', "%" . $title . "%");
		}
		if (isset($aSearch['iUserId'])) {
            //$sQuery .= "and um.user_id = $aaSearch['iUserId'] ";
			$oResult = $oResult->where('user_templates.user_id', $aSearch['iUserId']);
		}
		if (isset($aSearch['iTemplateId'])) {
            //$sQuery .= "and um.user_id = $aaSearch['iUserId'] ";
			$oResult = $oResult->where('t.id', $aSearch['iTemplateId']);
		}
		$oResult = $oResult->orderBy('t.id', 'asc');
		$oResult = $oResult->paginate(15);
		$oResult->setPath('templates');
		return $oResult;
	}
}
