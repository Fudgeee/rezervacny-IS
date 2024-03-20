<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ReservationController extends Controller
{
    public function reservation() {
        if (Session::has('loginId')) {
            $loginId = Session::get('loginId');
            $osoba = DB::table('user')->where('id', $loginId)->first();
            return view('reservation', compact('osoba'));
        }
        else {
            return view('reservation');
        }
    }
}
