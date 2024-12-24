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
        $kuota = Produk::select('kuota')->distinct()->get();

        return view('produk.layoutProduk', compact('paket', 'kategori', 'kecepatanProduk','kuota'));
    }


    public function filterByKategori(Request $request)
    {
        $kategoriId = $request->input('kategori');
        $minHarga = $request->input('min_harga');
        $maxHarga = $request->input('max_harga');
        $kecepatan = $request->input('kecepatan');
        $kuota = $request->input('kuota');

        // Query dasar untuk produk tanpa filter (ini kondisi reset)
        $produkQuery = Produk::query();

        // Hanya menambahkan filter jika ada input yang diberikan
        if ($kategoriId && $kategoriId !== 'all') {
            $produkQuery->where('id_kategori', $kategoriId);
        }

        if ($minHarga !== null && $maxHarga !== null) {
            $produkQuery->whereBetween('harga_produk', [$minHarga, $maxHarga]);
        }

        if (!empty($kecepatan)) {
            $produkQuery->whereIn('kecepatan', $kecepatan);
        }

        if (!empty($kuota)) {
            $produkQuery->where(function ($query) use ($kuota) {
                if (in_array('Unlimited', $kuota)) {
                    $query->whereNull('kuota');
                }

                $kuotaFiltered = array_filter($kuota, fn($k) => $k !== 'Unlimited');
                if (!empty($kuotaFiltered)) {
                    $query->orWhereIn('kuota', $kuotaFiltered);
                }
            });
        }

        // Jika tidak ada filter yang diterapkan, ambil semua produk
        $produkFiltered = $produkQuery->pluck('id_produk');

        $paket = Paket::whereHas('produk', function ($query) use ($produkFiltered) {
            $query->whereIn('id_produk', $produkFiltered);
        })->with([
                    'produk' => function ($query) use ($produkFiltered) {
                        $query->whereIn('id_produk', $produkFiltered);
                    }
                ])->get();

        // Kembalikan partial view untuk produk yang difilter
        return view('produk.produk', compact('paket'))->render();
    }


}
