<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdministrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class,'layout'])->name('layout');
// login
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login-user', [AuthController::class,'loginUser'])->name('login-user');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');

// registration
Route::get('/registration', [AuthController::class,'registration'])->name('registration');
Route::post('/registration', [AuthController::class,'register'])->name('register');

// zmena jazyka
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\LanguageController@switchLang']);

// rezervacia
Route::get('/reservation', [ReservationController::class,'reservation'])->name('reservation');

// administracia uzivatelov
Route::get('/administration', [AdministrationController::class,'administration'])->name('administration');