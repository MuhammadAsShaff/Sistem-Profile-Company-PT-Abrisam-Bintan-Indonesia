<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiLandingPage extends Controller
{
    public function index () {
        return view ('tentangKami.layoutTentangKami');
    }
}
