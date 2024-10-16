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

        // Ambil semua paket beserta produk terkait
        $paket = Paket::with('produk')->get(); 

        return view('produk.layoutProduk', compact('paket', 'kategori'));
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
            // Tampilkan semua paket dan produk jika "Semua Kategori" dipilih atau kategori tidak ada
            $paket = Paket::with('produk')->get();
        }

        // Kembalikan partial view untuk produk
        return view('produk.produk', compact('paket'))->render();
    }
}
