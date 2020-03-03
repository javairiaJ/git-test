<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

//    public function users() {
//        return $this->hasMany('App\User');
//    }

    public function parents() {
        return $this->belongsTo('App\Module', 'parent_id');
    }

    public function childs() {
        return $this->hasMany('App\Module', 'parent_id');
    }

//
    public static function searchModule(array $aSearch) {

        $result = self::select('modules.*')
                ->where("modules.parent_id", '=', 0)
                ->where("modules.deleted", '=', 0);

        if (isset($aSearch['status']) && $aSearch['status'] != "") {
            $status = $aSearch['status'];
            $result->where("modules.status", '=', $status);
        }

        if (isset($aSearch['parent_id']) && $aSearch['parent_id'] != "") {
            $parent_id = $aSearch['parent_id'];
            $result->where("modules.parent_id", '=', $parent_id);
        }

        if (isset($aSearch['title']) && $aSearch['title'] != "") {
            $title = $aSearch['title'];
            $result = $result->where('title', 'LIKE', "%" . $title . "%");
        }

        $result = $result->orderBy('modules.id', 'desc');
        $result = $result->paginate(15);
        $result->setPath('modules');
        return $result;
    }

}
