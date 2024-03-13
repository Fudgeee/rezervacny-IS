<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdministrationController extends Controller
{
    public function administration() {
        return view("administration");
    }
}
