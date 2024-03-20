<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class AdministrationController extends Controller
{
    public function administration() {
        if (Session::has('loginId')) {
            $loginId = Session::get('loginId');
            $osoba = DB::table('user')->where('id', $loginId)->first();
            $barbers = DB::table('user')->where('rola', '>', 0)->whereNotIn('id', [$loginId])->get();
            
            return view('administration', compact('osoba', 'barbers'));
        }
        else {
            return redirect('login')->with('fail', __('Prihláste sa, prosím.'));
        }
    }
}
