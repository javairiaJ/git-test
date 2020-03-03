<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Email extends Model
{
	public static function searchEmail($search) {

		$result = self::select('emails.*')
		->where("emails.deleted", '=', 0);

		if (isset($search['email']) && $search['email'] != "") {
			$email = $search['email'];
			$result = $result->where('email', 'LIKE', "%" . $email . "%");
		}
		$result = $result->where('emails.user_id', Auth::user()->id);
		$result = $result->orderBy('emails.id', 'desc');
		$result = $result->paginate(15);
		$result->setPath('emails');
		return $result;
	}
}
