<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    public function store(Request $request)
    {
        // Validasi input termasuk syarat_ketentuan
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar_kategori' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'syarat_ketentuan' => 'nullable|array', // syarat_ketentuan sebagai array
        ]);

        // Convert syarat_ketentuan array to JSON format
        $syaratKetentuanJson = !empty($validated['syarat_ketentuan']) ? json_encode($validated['syarat_ketentuan']) : null;

        // Data kategori yang akan disimpan
        $kategoriData = [
            'nama_kategori' => $validated['nama_kategori'],
            'deskripsi' => $validated['deskripsi'],
            'syarat_ketentuan' => $syaratKetentuanJson, // Simpan sebagai JSON
        ];

        // Simpan gambar jika ada
        if ($request->hasFile('gambar_kategori')) {
            $file = $request->file('gambar_kategori');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/kategori');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1080, 1080, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $kategoriData['gambar_kategori'] = $filename;
        }

        // Simpan kategori ke database
        Kategori::create($kategoriData);

        return redirect()->route('dashboard.dataKategori.dataKategori')->with('success', 'Kategori berhasil ditambahkan');
    }


    public function update(Request $request, $id_kategori)
    {
        // Temukan kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id_kategori);

        // Validasi input termasuk syarat_ketentuan
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar_kategori' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'syarat_ketentuan' => 'nullable|array', // syarat_ketentuan sebagai array
        ]);

        // Convert syarat_ketentuan array to JSON format
        $validated['syarat_ketentuan'] = !empty($validated['syarat_ketentuan']) ? json_encode($validated['syarat_ketentuan']) : null;

        // Update data kategori
        $kategori->nama_kategori = $validated['nama_kategori'];
        $kategori->deskripsi = $validated['deskripsi'];
        $kategori->syarat_ketentuan = $validated['syarat_ketentuan']; // Update syarat_ketentuan sebagai JSON

        // Simpan gambar jika ada
        if ($request->hasFile('gambar_kategori')) {
            // Hapus gambar lama jika ada
            if ($kategori['gambar_kategori'] && file_exists(public_path('uploads/kategori/' . $kategori['gambar_kategori']))) {
                unlink(public_path('uploads/kategori/' . $kategori['gambar_kategori']));
            }

            // Upload gambar baru
            $file = $request->file('gambar_kategori');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Memastikan direktori tujuan ada
            $destinationPath = public_path('uploads/kategori');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1080, 1080, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $kategori['gambar_kategori'] = $filename;
        }

        // Simpan perubahan
        $kategori->save();


        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.dataKategori.dataKategori')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);

        // Hapus gambar kategori jika ada
        if ($kategori->gambar_kategori && file_exists(public_path('uploads/kategori/' . $kategori->gambar_kategori))) {
            unlink(public_path('uploads/kategori/' . $kategori->gambar_kategori));
        }

        // Hapus kategori
        $kategori->delete();

        return redirect()->route('dashboard.dataKategori.dataKategori')->with('success', 'Kategori berhasil dihapus');
    }
}
