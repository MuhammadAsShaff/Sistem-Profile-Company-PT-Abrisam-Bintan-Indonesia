<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Produk;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session sebelum mengunjungi halaman index
        session(['previous_url' => request()->fullUrl()]);

        // Ambil query pencarian
        $search = $request->input('search');

        // Query dasar untuk mengambil semua paket
        $query = Paket::withCount('produk');
        
        // Filter berdasarkan pencarian nama
        if (!empty($search)) {
            $query->where('nama_paket', 'like', '%' . $search . '%');
        }

        // Lakukan paginasi dengan limit 7
        $pakets = $query->paginate(7);

        // Hitung total paket
        $paketCount = Paket::count();
        $produkCount = Produk::count(); // Jumlah total produk

        // Kirim data ke view
        return view('dashboard.dataPaket.dataPaket', compact('pakets', 'paketCount', 'produkCount','search'));
    }

    public function showProdukByPaket($id_paket)
    {
        // Ambil kategori berdasarkan ID dan produk terkait
        $paket = Paket::with('produk')->findOrFail($id_paket);

        return response()->json($paket->produk); // Kirim data produk sebagai response JSON untuk modal
    }

    public function store(Request $request)
    {
        // Validasi input termasuk deskripsi
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255', // Validasi deskripsi
        ]);

        // Persiapan data paket baru termasuk deskripsi
        $paketData = [
            'nama_paket' => $request->input('nama_paket'),
            'deskripsi' => $request->input('deskripsi'), // Simpan deskripsi
        ];

        // Simpan data paket ke database
        Paket::create($paketData);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.dataPaket.dataPaket')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function destroy($id_paket)
    {
        // Temukan paket berdasarkan ID
        $paket = Paket::find($id_paket);

        // Cek apakah paket ditemukan
        if (!$paket) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if ($paket->gambar_paket && file_exists(public_path('uploads/paket/' . $paket->gambar_paket))) {
            unlink(public_path('uploads/paket/' . $paket->gambar_paket));
        }

        // Hapus paket
        $paket->delete();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('dashboard.dataPaket.dataPaket')->with('success', 'Paket berhasil dihapus.');
    }

    public function update(Request $request, $id_paket)
    {
        // Ambil paket yang akan diupdate berdasarkan ID
        $paket = Paket::find($id_paket);

        // Cek apakah paket ditemukan
        if (!$paket) {
            return redirect()->back()->with('error', 'Paket tidak ditemukan.');
        }

        // Validasi data yang diinput
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255', // Validasi deskripsi
        ]);

        // Update data paket
        $paket->nama_paket = $request->input('nama_paket');
        $paket->deskripsi = $request->input('deskripsi'); // Pastikan ini mengupdate deskripsi

        // Simpan perubahan ke database
        $paket->save();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.dataPaket.dataPaket')->with('success', 'Paket berhasil diupdate.');
    }
}
