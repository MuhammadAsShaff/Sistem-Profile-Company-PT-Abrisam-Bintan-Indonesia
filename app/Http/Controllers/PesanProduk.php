<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanProduk extends Controller
{
    public function index(Request $request)
    {
        return view('pesanProduk.pesanProduk');
    }
}
