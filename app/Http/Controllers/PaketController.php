<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session sebelum mengunjungi halaman index
        session(['previous_url' => request()->fullUrl()]);

        // Ambil query pencarian
        $search = $request->input('search');

        // Query dasar untuk mengambil semua produk
        $query = Produk::orderBy('updated_at', 'desc');

        // Filter berdasarkan pencarian nama
        if (!empty($search)) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        // Lakukan paginasi dengan limit 7
        $produks = $query->paginate(7);

        // Hitung total produk
        $produkCount = Produk::count(); // Jumlah total produk

        // Kirim data ke view
        return view('dashboard.dataProduk.dataProduk', compact('produks', 'produkCount', 'search'));
    }

    public function store(Request $request)
    {
        // Validasi input termasuk deskripsi
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255', // Tambahkan validasi deskripsi
            'gambar_produk' => 'nullable|mimes:jpg,jpeg,png|max:10000', // Gambar opsional
        ]);

        // Persiapan data produk baru termasuk deskripsi
        $produkData = [
            'nama_produk' => $request->input('nama_produk'),
            'deskripsi' => $request->input('deskripsi'), // Simpan deskripsi
        ];

        // Jika ada file gambar diupload, simpan file
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Memastikan direktori tujuan ada
            $destinationPath = public_path('uploads/produk');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Simpan file gambar ke direktori
            $file->move($destinationPath, $filename);
            $produkData['gambar_produk'] = $filename; // Menyimpan nama file gambar
        }

        // Simpan data produk ke database
        Produk::create($produkData);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function destroy($id_produk)
    {
        // Temukan produk berdasarkan ID
        $produk = Produk::find($id_produk);

        // Cek apakah produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if ($produk->gambar_produk && file_exists(public_path('uploads/produk/' . $produk->gambar_produk))) {
            unlink(public_path('uploads/produk/' . $produk->gambar_produk));
        }

        // Hapus produk
        $produk->delete();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil dihapus.');
    }

    public function update(Request $request, $id_produk)
    {
        // Ambil produk yang akan diupdate berdasarkan ID
        $produk = Produk::find($id_produk);

        // Cek apakah produk ditemukan
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Validasi data yang diinput
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255', // Deskripsi juga divalidasi
            'gambar_produk' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data produk
        $produk->nama_produk = $request->input('nama_produk');
        $produk->deskripsi = $request->input('deskripsi'); // Pastikan ini mengupdate deskripsi

        // Jika ada file gambar diupload, simpan file baru
        if ($request->hasFile('gambar_produk')) {
            // Hapus file gambar lama jika ada
            if ($produk->gambar_produk && file_exists(public_path('uploads/produk/' . $produk->gambar_produk))) {
                unlink(public_path('uploads/produk/' . $produk->gambar_produk));
            }

            // Upload file baru
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $filename);
            $produk->gambar_produk = $filename;
        }

        // Simpan perubahan ke database
        $produk->save();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil diupdate.');
    }

}
