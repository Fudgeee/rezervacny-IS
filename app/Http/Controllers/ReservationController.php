<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReservationController extends Controller
{
    public function reservation() {
        return view("reservation");
    }
}
