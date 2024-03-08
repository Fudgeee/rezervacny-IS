<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;

class AuthController extends Controller
{
    public function login() {
        return view("login");
    }

    public function registration() {
        return view("registration");
    }

    public function register() {
        return view("registration");
    }

    public function loginUser(Request $request) {
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        $osoba = DB::table('user')->where('login','=',$request->name)->first();
        if($osoba) {
            if(Hash::check($request->password,$osoba->heslo)) {
                $request->session()->put('loginId',$osoba->id);

                // Po prihlásení získať a použiť uloženú URL
                $preLoginUrl = session('preLoginUrl', 'dashboard');
                if ($preLoginUrl == '' || strpos($preLoginUrl, '/login') !== false) {
                    return redirect('/welcome');
                }
                else {
                    return redirect($preLoginUrl);
                }
            }
            else {
                return back()->with('fail',__('Nesprávne Heslo'));
            }
        }
        else {
            return back()->with('fail',__('Uživateľ s týmto menom neexistuje'));
        }
    }

    public function logout() {
        if(Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('/login')->with('fail', __('Vaše prihlásenie vypršalo. Prihláste sa prosím znovu.'));
        }
    }
}
