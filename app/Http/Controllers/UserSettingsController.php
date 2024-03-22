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
                if (($request->stare_heslo != null) && ($request->nove_heslo != null) && ($request->nove_heslo_potvrdenie != null)) {
                    $loginId = Session::get('loginId');
                    $osoba = DB::table('user')->where('id', $loginId)->first();
                    if (Hash::check($request->stare_heslo, $osoba->heslo)) {
                        if ($request->nove_heslo == $request->nove_heslo_potvrdenie) {
                            // Aktualizace hesla v databázi
                            DB::table('user')->where('id', '=', Session::get('loginId'))->update([
                                'heslo' => Hash::make($request->nove_heslo),
                                'meno' => $request->meno,
                                'priezvisko' => $request->priezvisko,
                                'telefon' => $request->telefon
                            ]);
                            return back()->with('success', __('Údaje boli úspešne zmenené'));
                        }
                        else {
                            return back()->with('fail', __('Nové heslo a potvrdenie nového hesla sa nezhodujú.'));
                        }
                    }
                    else {
                        return back()->with('fail', __('Zadané staré heslo nie je platné.'));
                    }
                }
                else {
                    $osoba = DB::table('user')->where('id','=',Session::get('loginId'))->update([
                        'meno' => $request->meno,
                        'priezvisko' => $request->priezvisko,
                        'telefon' => $request->telefon
                    ]);
                    return back()->with('success', __('Údaje boli úspešne zmenené'));
                }
            }
        }
        else {
            session(['preLoginUrl' => url()->previous()]);
            return redirect('login')->with('fail', __('Vaše prihlásenie vypršalo, prihláste sa prosím znovu.'));
        }
    }
}
