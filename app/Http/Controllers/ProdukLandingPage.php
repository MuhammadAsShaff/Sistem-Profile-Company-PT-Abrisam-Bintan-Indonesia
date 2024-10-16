<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Paket;
use App\Models\Kategori;

class ProdukLandingPage extends Controller
{
    public function index()
    {
        return view('produk.layoutProduk');
    }
}
