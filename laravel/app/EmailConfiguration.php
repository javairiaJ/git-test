<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class EmailConfiguration extends Model
{
	public static function searchEmailConfiguration($search) {

		$result = self::select('email_configurations.*');
		//->where("emails.deleted", '=', 0);
		if (isset($search['host']) && $search['host'] != "") {
			$host = $search['host'];
			$result = $result->where('host', 'LIKE', "%" . $host . "%");
		}
		if (isset($search['email']) && $search['email'] != "") {
			$email = $search['email'];
			$result = $result->where('username', 'LIKE', "%" . $email . "%");
		}
		//$result = $result->where('emails.user_id', Auth::user()->id);
		$result = $result->orderBy('email_configurations.id', 'desc');
		$result = $result->paginate(15);
		$result->setPath('email-configurations');
		return $result;
	}
}
