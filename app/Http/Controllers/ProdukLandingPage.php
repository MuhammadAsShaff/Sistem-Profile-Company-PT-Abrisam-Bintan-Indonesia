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
        $paketId = $request->input('paket'); // Dapatkan paket ID dari permintaan

        // Jika ada paket yang dipilih, ambil produk berdasarkan paket tersebut
        if ($paketId) {
            $paket = Paket::with('produk')->findOrFail($paketId);
            $produk = $paket->produk;
        } else {
            $paket = Paket::with('produk')->get(); // Ambil semua paket beserta produk terkait
        }

        return view('produk.layoutProduk', compact('paket')); // Kirim data paket ke view
    }

    public function getProdukByPaket(Request $request)
    {
        $paketId = $request->input('paket'); // Ambil ID paket dari request
        $produk = Produk::where('id_paket', $paketId)->get(); // Ambil produk berdasarkan paket

        return response()->json([
            'produk' => $produk,
        ]);
    }


}
