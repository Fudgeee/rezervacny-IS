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
            $barbers = DB::table('user')->where('rola', '>', 0)->where('rola', '<', $osoba->rola)->whereNotIn('id', [$loginId])->get();
            
            return view('administration', compact('osoba', 'barbers'));
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('login')->with('fail', __('Vaše prihlásenie vypršalo. Prihláste sa prosím znovu.'));
        }
    }

    public function deleteUser(Request $request) {
        if(Session::has('loginId')) {
            $tmp = DB::table('user')->where('id', '=', $request->id)->delete();
            return back()->with('success',__('Osoba bola úspešne vymazaná z databázy.'));      
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('/login')->with('fail', __('Vaše prihlásenie vypršalo. Prihláste sa prosím znovu.'));
        }
    }
}
