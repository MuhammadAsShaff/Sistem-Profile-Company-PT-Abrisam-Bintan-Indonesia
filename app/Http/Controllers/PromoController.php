<?php

namespace App\Http\Controllers;
use App\Models\Promo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        // Save the last URL to the session before visiting the index page
        session(['previous_url' => $request->fullUrl()]);

        // Get search query
        $search = $request->input('search');

        // Base query to retrieve all promos
        $query = Promo::query();

        // Filter by search term
        if (!empty($search)) {
            $query->where('nama_promo', 'like', '%' . $search . '%');
        }

        // Paginate results with a limit of 7
        $promos = $query->paginate(5);
        $promoCount = Promo::count();

        // Send data to the view
        return view('dashboard.Promo.Promo', compact('promos', 'promoCount', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000', // Validasi deskripsi
            'gambar_promo' => 'nullable|mimes:jpg,jpeg,png|max:2048', // Gambar opsional
        ]);

        // Persiapan data promo baru
        $promoData = [
            'nama_promo' => $request->input('nama_promo'),
            'deskripsi' => $request->input('deskripsi'), // Pastikan deskripsi disimpan
        ];

        // Jika ada file gambar diupload, simpan file
        if ($request->hasFile('gambar_promo')) {
            $file = $request->file('gambar_promo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Memastikan direktori tujuan ada
            $destinationPath = public_path('uploads/promos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1400, 500, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $promoData['gambar_promo'] = $filename;
        }

        // Simpan data promo ke database
        Promo::create($promoData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('dashboard.Promo.Promo')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function update(Request $request, $id_promo)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000', // Validasi deskripsi dengan batas maksimum 1000 karakter
            'gambar_promo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar promo, maksimal 10MB
        ]);

        // Temukan promo berdasarkan ID
        $promo = Promo::findOrFail($id_promo);

        // Update data promo dengan data yang divalidasi
        $promo->nama_promo = $validatedData['nama_promo'];
        $promo->deskripsi = $validatedData['deskripsi'];

        // Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('gambar_promo')) {
            // Hapus gambar lama jika ada
            if ($promo->gambar_promo && file_exists(public_path('uploads/promos/' . $promo->gambar_promo))) {
                unlink(public_path('uploads/promos/' . $promo->gambar_promo));
            }

            // Upload gambar baru
            $file = $request->file('gambar_promo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Memastikan direktori tujuan ada
            $destinationPath = public_path('uploads/promos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1400, 500, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $promo->gambar_promo = $filename;
        }

        // Simpan perubahan ke database
        $promo->save();

        // Redirect ke halaman promo dengan pesan sukses
        return redirect()->route('dashboard.Promo.Promo')->with('success', 'Promo berhasil diperbarui.');
    }



    public function destroy($id_promo)
    {
        // Find the promo by its ID
        $promo = Promo::findOrFail($id_promo);

    
        if ($promo->gambar_promo && file_exists(public_path('uploads/promos/' . $promo->gambar_promo))) {
            unlink(public_path('uploads/promos/' . $promo->gambar_promo));
        }

        // Delete the promo record from the database
        $promo->delete();

        // Redirect with success message
        return redirect()->route('dashboard.Promo.Promo')->with('success', 'Promo berhasil dihapus.');
    }


}
