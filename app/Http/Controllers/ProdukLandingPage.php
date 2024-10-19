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

        // Query dasar untuk produk
        $produkQuery = Produk::query();

        // Filter berdasarkan kategori jika ada
        if ($kategoriId && $kategoriId !== 'all') {
            $produkQuery->where('id_kategori', $kategoriId);
        }

        // Filter harga jika ada rentang harga
        if ($minHarga !== null && $maxHarga !== null) {
            $produkQuery->whereBetween('harga_produk', [$minHarga, $maxHarga]);
        }

        // Filter kecepatan jika ada pilihan kecepatan
        if (!empty($kecepatan)) {
            $produkQuery->whereIn('kecepatan', $kecepatan);
        }

        // Filter kuota jika ada pilihan kuota
        if (!empty($kuota)) {
            $produkQuery->where(function ($query) use ($kuota) {
                // Filter untuk kuota Unlimited (null dalam database)
                if (in_array('Unlimited', $kuota)) {
                    $query->whereNull('kuota');
                }
                // Filter untuk kuota spesifik selain Unlimited
                $kuotaFiltered = array_filter($kuota, fn($k) => $k !== 'Unlimited');
                if (!empty($kuotaFiltered)) {
                    $query->orWhereIn('kuota', $kuotaFiltered);
                }
            });
        }

        // Ambil produk yang sudah difilter
        $produkFiltered = $produkQuery->pluck('id_produk'); // Mengambil ID produk hasil filter

        // Ambil paket yang hanya mengandung produk yang sudah difilter
        $paket = Paket::whereHas('produk', function ($query) use ($produkFiltered) {
            $query->whereIn('id_produk', $produkFiltered); // Menyaring paket berdasarkan produk yang telah difilter
        })->with([
                    'produk' => function ($query) use ($produkFiltered) {
                        $query->whereIn('id_produk', $produkFiltered); // Mengambil produk yang terkait dengan paket yang sesuai dengan filter
                    }
                ])->get();

        // Kembalikan partial view untuk produk yang difilter
        return view('produk.produk', compact('paket'))->render();
    }
}
