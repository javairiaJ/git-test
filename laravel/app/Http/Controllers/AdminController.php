<?php

namespace App\Http\Controllers;

class AdminController extends Controller {

    public function __construct() {
        session_start();
        $this->middleware('admin.auth');
    }

}
