<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Validator;
use Hash;

class UserSettingsController extends Controller
{
    public function userSettings() {
        if (Session::has('loginId')) {
            $loginId = Session::get('loginId');
            $osoba = DB::table('user')->where('id', $loginId)->first();
            
            return view('user-settings', compact('osoba'));
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('login')->with('fail', __('Vaše prihlásenie vypršalo, prihláste sa prosím znovu.'));
        }
    }

    public function userSettingsUpdate(Request $request) {
        if (Session::has('loginId')) {
            $validator = Validator::make($request->all(), [
                'meno' => 'required',
                'priezvisko' => 'required',
                'telefon' => 'required|regex:/^\+?[0-9]+$/'
            ]);

            if ($validator->fails()){
                return back()->with('fail', __('Prosím vyplňte všetky povinné polia'));
            }
            else{
                $osoba = DB::table('user')->where('id','=',Session::get('loginId'))->update([
                    'meno' => $request->meno,
                    'priezvisko' => $request->priezvisko,
                    'telefon' => $request->telefon,
                    'iban' => $request->iban ? $request->iban : "" 
                ]);
                return back()->with('success', __('Údaje boli úspešne zmenené'));
            }
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('login')->with('fail', __('Vaše prihlásenie vypršalo, prihláste sa prosím znovu.'));
        }
    }

    public function userSettingsUpdatePw(Request $request) {
        if (Session::has('loginId')) {
            $validator = Validator::make($request->all(), [
                'stare_heslo' => 'required',
                'nove_heslo' => 'required',
                'nove_heslo_potvrdenie' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('fail1', __('Prosím vyplňte všetky povinné polia'));
            }
            else {
                $loginId = Session::get('loginId');
                $osoba = DB::table('user')->where('id', $loginId)->first();
                if (Hash::check($request->stare_heslo, $osoba->heslo)) {
                    if (strlen($request->nove_heslo) > 5) {
                        if ($request->nove_heslo == $request->nove_heslo_potvrdenie) {
                            // Aktualizace hesla v databázi
                            DB::table('user')->where('id', '=', Session::get('loginId'))->update([
                                'heslo' => Hash::make($request->nove_heslo),
                            ]);
                            return back()->with('success1', __('Heslo bolo úspešne zmenené'));
                        }
                        else {
                            return back()->with('fail1', __('Nové heslo a potvrdenie nového hesla sa nezhodujú.'));
                        }
                    }
                    else {
                        return back()->with('fail1', __('Nové heslo musí mať aspoň 6 znakov.')); 
                    }
                }
                else {
                    return back()->with('fail1', __('Zadané staré heslo nie je platné.'));
                }
            }
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('login')->with('fail', __('Vaše prihlásenie vypršalo, prihláste sa prosím znovu.'));
        }
    }
}
