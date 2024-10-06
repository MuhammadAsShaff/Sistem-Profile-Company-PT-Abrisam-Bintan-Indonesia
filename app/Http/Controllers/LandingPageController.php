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
        // Ambil semua paket dan kategori
        $paket = Paket::all();
        $kategori = Kategori::all();

        // Ambil semua promo
        $promos = Promo::all();

        // Inisialisasi produk sebagai semua produk
        $produk = Produk::with('paket')->get();

        // Inisialisasi variabel kategoriDipilih sebagai null atau default value
        $kategoriDipilih = null;

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && !empty($request->input('kategori'))) {
            $kategoriDipilih = $request->input('kategori');
            $produk = Produk::where('id_kategori', $kategoriDipilih)
                ->with('paket')
                ->get();
        }

        // Filter lebih lanjut berdasarkan paket jika kategori sudah dipilih dan paket juga dipilih
        if ($request->has('paket') && !empty($request->input('paket')) && $kategoriDipilih !== null) {
            $paketDipilih = $request->input('paket');
            $produk = Produk::where('id_kategori', $kategoriDipilih) // Tetap berdasarkan kategori
                ->where('id_paket', $paketDipilih) // Ditambah filter paket
                ->with('paket')
                ->get();
        }

        // Jika request via AJAX, kirim data produk sebagai JSON
        if ($request->ajax()) {
            return response()->json([
                'produk' => $produk
            ]);
        }

        // Return ke view dengan data kategori, produk, promos, dan paket
        return view('landingPage.layoutLandingPage', compact('kategori', 'produk', 'promos', 'paket'));
    }

}
