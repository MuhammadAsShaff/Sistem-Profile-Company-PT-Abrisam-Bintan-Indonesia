<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Paket;
use App\Models\Kategori;

class ProdukLandingPage extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all(); // Ambil semua kategori
        $paket = Paket::with('produk')->get(); // Ambil semua paket beserta produk terkait

        // Ambil kecepatan unik dari produk untuk digunakan di filter
        $kecepatanProduk = Produk::select('kecepatan')->distinct()->get();

        return view('produk.layoutProduk', compact('paket', 'kategori', 'kecepatanProduk'));
    }


    public function filterByKategori(Request $request)
    {
        $kategoriId = $request->input('kategori'); // Ambil ID kategori dari request

        // Cek apakah kategori yang dipilih adalah "all" atau tidak ada kategori yang dipilih
        if ($kategoriId && $kategoriId !== 'all') {
            // Filter produk berdasarkan kategori yang dipilih
            $paket = Paket::whereHas('produk', function ($query) use ($kategoriId) {
                $query->where('id_kategori', $kategoriId);
            })->with([
                        'produk' => function ($query) use ($kategoriId) {
                            $query->where('id_kategori', $kategoriId);
                        }
                    ])->get();
        } else {
            // Jika "Semua Kategori" dipilih, tampilkan semua paket dan produk
            $paket = Paket::with('produk')->get();
        }

        // Kembalikan partial view untuk produk (menggunakan AJAX untuk mengganti isi produk)
        return view('produk.produk', compact('paket'))->render();
    }
}
