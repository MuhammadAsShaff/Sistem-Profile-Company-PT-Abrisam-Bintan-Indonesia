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
        $produk = Produk::with('paket')->get(); // Menampilkan semua produk awalnya

        // Jika hanya paket dipilih tanpa kategori
        if ($request->has('paket') && !empty($request->input('paket')) && empty($request->input('kategori'))) {
            $paketDipilih = $request->input('paket');
            $produk = Produk::where('id_paket', $paketDipilih) // Filter produk hanya berdasarkan paket
                ->with('paket')
                ->get();
        }

        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori') && !empty($request->input('kategori'))) {
            $kategoriDipilih = $request->input('kategori');
            $produk = Produk::where('id_kategori', $kategoriDipilih)
                ->with('paket')
                ->get();

            // Ambil paket yang memiliki produk pada kategori yang dipilih
            $paket = Paket::whereHas('produk', function($query) use ($kategoriDipilih) {
                $query->where('id_kategori', $kategoriDipilih);
            })->get();
        }

        // Filter berdasarkan paket jika kategori juga dipilih
        if ($request->has('paket') && !empty($request->input('paket')) && !empty($request->input('kategori'))) {
            $paketDipilih = $request->input('paket');
            $produk = Produk::where('id_kategori', $request->input('kategori'))
                ->where('id_paket', $paketDipilih) // Ditambah filter paket
                ->with('paket')
                ->get();
        }

        // Jika request via AJAX, kirim data produk dan paket sebagai JSON
        if ($request->ajax()) {
            return response()->json([
                'produk' => $produk,
                'paket' => $paket, // Kirim paket yang sesuai
            ]);
        }

        // Return ke view dengan data kategori, produk, promos, dan paket
        return view('landingPage.layoutLandingPage', compact('kategori', 'produk', 'promos', 'paket'));
    }

    public function tampilKontak(){

        return view('kontak.layoutKontak');

    }
}
