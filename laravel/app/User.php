<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function modules() {
        return $this->belongsTo('App\Module');
    }

    public static function searchUser($search) {

        $result = User::select('users.*')
                ->where("users.deleted", '=', 0);

        if (isset($search['status']) && $search['status'] != "") {
            $status = $search['status'];
            $result->where("users.status", '=', $status);
        }

        if (isset($search['firstName']) && $search['firstName'] != "") {
            $firstName = $search['firstName'];
            $result = $result->where('firstName', 'LIKE', "%" . $firstName . "%");
        }

        if (isset($search['lastName']) && $search['lastName'] != "") {
            $lastName = $search['lastName'];
            $result = $result->where('lastName', 'LIKE', "%" . $lastName . "%");
        }
        if (isset($search['email']) && $search['email'] != "") {
            $email = $search['email'];
            $result = $result->where('email', 'LIKE', "%" . $email . "%");
        }

        //$result = $result->where('role_id', '!=', 1);
        $result = $result->orderBy('users.id', 'desc');
        $result = $result->paginate(15);
        $result->setPath('users');
        return $result;
    }

}
