<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session sebelum mengunjungi halaman index
        session(['previous_url' => request()->fullUrl()]);

        // Ambil query pencarian
        $search = $request->input('search');

        // Query dasar untuk mengambil semua kategori dan hitung jumlah produk terkait
        $query = Kategori::withCount('produk');

        // Filter berdasarkan pencarian nama
        if (!empty($search)) {
            $query->where('nama_kategori', 'like', '%' . $search . '%');
        }

        // Lakukan paginasi dengan limit 5
        $kategoris = $query->paginate(5);

        // Hitung total kategori dan produk
        $kategoriCount = Kategori::count();
        
        // Kirim data ke view
        return view('dashboard.dataKategori.dataKategori', compact('kategoris', 'kategoriCount', 'search'));
    }

    public function showProdukByKategori($id_kategori)
    {
        // Ambil kategori berdasarkan ID dan produk terkait
        $kategori = Kategori::with('produk')->findOrFail($id_kategori);

        return response()->json($kategori->produk); // Kirim data produk sebagai response JSON untuk modal
    }


    public function store(Request $request)
    {
        // Validasi input termasuk deskripsi
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string', // Pastikan validasi untuk deskripsi
            'gambar_kategori' => 'nullable|mimes:jpg,jpeg,png|max:10000', // Gambar opsional
        ]);

        // Persiapan data kategori baru
        $kategoriData = [
            'nama_kategori' => $request->input('nama_kategori'),
            'deskripsi' => $request->input('deskripsi'), // Menyimpan deskripsi
        ];

        // Simpan gambar jika ada
        if ($request->hasFile('gambar_kategori')) {
            $file = $request->file('gambar_kategori');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kategori'), $filename);
            $kategoriData['gambar_kategori'] = $filename;
        }

        // Simpan data kategori ke database
        Kategori::create($kategoriData);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.dataKategori.dataKategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id_kategori)
    {
        // Temukan kategori berdasarkan ID
        $kategori = Kategori::find($id_kategori);

        // Cek apakah kategori ditemukan
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if ($kategori->gambar_kategori && file_exists(public_path('uploads/kategori/' . $kategori->gambar_kategori))) {
            unlink(public_path('uploads/kategori/' . $kategori->gambar_kategori));
        }

        // Hapus kategori
        $kategori->delete();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('dashboard.dataKategori.dataKategori')->with('success', 'Kategori berhasil dihapus.');
    }

    public function update(Request $request, $id_kategori)
    {
        // Validasi input termasuk deskripsi
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string', // Pastikan validasi untuk deskripsi
            'gambar_kategori' => 'nullable|mimes:jpg,jpeg,png|max:2048', // Gambar opsional
        ]);

        // Ambil kategori
        $kategori = Kategori::find($id_kategori);

        // Update data kategori
        $kategori->nama_kategori = $request->input('nama_kategori');
        $kategori->deskripsi = $request->input('deskripsi'); // Menyimpan deskripsi

        // Update gambar jika ada
        if ($request->hasFile('gambar_kategori')) {
            if ($kategori->gambar_kategori && file_exists(public_path('uploads/kategori/' . $kategori->gambar_kategori))) {
                unlink(public_path('uploads/kategori/' . $kategori->gambar_kategori));
            }

            $file = $request->file('gambar_kategori');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kategori'), $filename);
            $kategori->gambar_kategori = $filename;
        }

        // Simpan perubahan
        $kategori->save();

        return redirect()->route('dashboard.dataKategori.dataKategori')->with('success', 'Kategori berhasil diupdate.');
    }

}
