<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use Validator;

class AuthController extends Controller
{
    public function login() {
        return view("login");
    }

    public function registration() {
        return view("registration");
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email|unique:user,email',
            'password'=>'required|min:6',
            'password_confirmation'=>'same:password|required',
            'meno'=>'required',
            'priezvisko'=>'required',
            'telefon'=>'required'
        ]);
        
        if ($validator->fails()){
            return back()->with('fail',__('Prosím vyplňte všetky povinné polia'));
        }
        else {
            $osoba = DB::table('user')->where('email','=',$request->email)->first();
            if($osoba) {
                return back()->with('fail',__('Uživateľ s týmto e-mailom už existuje'));
            }
            else {
                DB::table('user')->insert([
                    'email' => $request->email,
                    'heslo' => Hash::make($request->heslo),
                    'rola' => 0,
                    'meno' => $request->meno,
                    'priezvisko' => $request->priezvisko,
                    'telefon' => $request->telefon
                ]);
                return back()->with('success',__('Registrácia prebehla úspešne'));
            }
        }
    }

    public function loginUser(Request $request) {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $osoba = DB::table('user')->where('email','=',$request->email)->first();
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
            return back()->with('fail',__('Uživateľ s týmto e-mailom neexistuje'));
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
