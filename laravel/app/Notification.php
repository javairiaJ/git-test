<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Notification extends Model
{
	public static function searchNotification($search) {

		$result = self::select('notifications.*')
		->where("notifications.deleted", '=', 0);

		if (isset($search['status']) && $search['status'] != "") {
			$status = $search['status'];
			$result->where("notifications.status", '=', $status);
		}

		if (isset($search['description']) && $search['description'] != "") {
			$description = $search['description'];
			$result = $result->where('description', 'LIKE', "%" . $description . "%");
		}
		$result = $result->where('notifications.user_id', Auth::user()->id);
		$result = $result->orderBy('notifications.id', 'desc');
		$result = $result->paginate(15);
		$result->setPath('notifications');
		return $result;
	}
}
