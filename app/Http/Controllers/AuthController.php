<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Hash;
use DB;
use Validator;

class AuthController extends Controller
{
    public function login() {
        if (Session::has('loginId')) {
            return redirect(route('layout'));
        }
        return view("login");
    }

    public function registration() {
        if (Session::has('loginId')) {
            return redirect(route('layout'));
        }
        return view("registration");
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password|required',
            'meno' => 'required',
            'priezvisko' => 'required',
            'telefon' => 'required|regex:/^\+?[0-9]+$/'
        ],[
            'email.required' => __('E-mailová adresa je povinná.'),
            'email.email' => __('Zadejte prosím platnú e-mailovú adresu.'),
            'email.unique' => __('Táto e-mailová adresa je už zaregistrovaná.'),
            'password.required' => __('Povinný údaj'),
            'password.min' => __('Heslo musí mať aspoň 6 znakov.'),
            'password_confirmation.same' => __('Heslá sa nezhodujú.'),
            'password_confirmation.required' => __('Povinný údaj'),
            'meno.required' => __('Povinný údaj'),
            'priezvisko.required' => __('Povinný údaj'),
            'telefon.required' => __('Povinný údaj'),
            'telefon.regex' => __('Telefónne číslo musí obsahovať iba číslice a môže začínať znakom "+".'),
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $osoba = DB::table('user')->where('email','=',$request->email)->first();
        if($osoba) {
            return back()->with('fail',__('Uživateľ s týmto e-mailom už existuje'));
        }
        else {
            DB::table('user')->insert([
                'email' => $request->email,
                'heslo' => Hash::make($request->password),
                'rola' => 0,
                'meno' => $request->meno,
                'priezvisko' => $request->priezvisko,
                'telefon' => $request->telefon
            ]);
            return redirect('login')->with('success',__('Registrácia prebehla úspešne, prosím prihláste sa.'));
        }
    }

    public function loginUser(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $osoba = DB::table('user')->where('email','=',$request->email)->first();

        if ($osoba) {
            if (Hash::check($request->password, $osoba->heslo)) {
                $request->session()->put('loginId',$osoba->id);

                // Po prihlásení získať a použiť uloženú URL
                $preLoginUrl = session('preLoginUrl');
                if ($preLoginUrl == '' || strpos($preLoginUrl, '/login') !== false) {
                    return redirect('/')->with('osoba', $osoba);
                }
                else {
                    return redirect($preLoginUrl)->with('osoba', $osoba);
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
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('/login')->with('fail', __('Vaše prihlásenie vypršalo. Prihláste sa prosím znovu.'));
        }
    }
}
