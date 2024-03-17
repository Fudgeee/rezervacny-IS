<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class AdministrationController extends Controller
{
    public function administration() {
        if (Session::has('loginId')) {
            return view("administration");
        }
        else {
            return redirect('login')->with('fail', __('Prihláste sa, prosím.'));
        }
    }
}
