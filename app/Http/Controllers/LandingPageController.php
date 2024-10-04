<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Kategori;
use App\Models\Paket;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori
        $kategori = Kategori::all();

        // Ambil semua promo
        $promos = Promo::all();

        // Jika ada filter kategori, ambil produk berdasarkan kategori
        if ($request->has('kategori') && !empty($request->input('kategori'))) {
            $kategoriDipilih = $request->input('kategori');

            // Pastikan kategori yang dipilih valid
            $produk = Produk::where('id_kategori', $kategoriDipilih)
                ->with('paket') // Mengambil relasi Paket juga
                ->get();
        } else {
            // Jika tidak ada filter, tampilkan semua produk
            $produk = Produk::with('paket')->get();
        }

        // Return ke view dengan data kategori, produk, dan promo
        return view('landingPage.layoutLandingPage', compact('kategori', 'produk', 'promos'));
    }

}
