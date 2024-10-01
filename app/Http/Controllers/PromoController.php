<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('dashboard.Promo.Promo', compact('promos', 'promoCount','search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000', // Validasi deskripsi
            'gambar_promo' => 'nullable|mimes:jpg,jpeg,png|max:10000', // Gambar opsional
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

            // Simpan file gambar ke direktori
            $file->move($destinationPath, $filename);
            $promoData['gambar_promo'] = $filename; // Menyimpan nama file gambar
        }

        // Simpan data promo ke database
        Promo::create($promoData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('dashboard.Promo.Promo')->with('success', 'Promo berhasil ditambahkan.');
    }


    public function destroy($id_promo)
    {
        // Find the promo by its ID
        $promo = Promo::findOrFail($id_promo);

        // If there's an associated image, delete it
        if ($promo->gambar && Storage::disk('public')->exists($promo->gambar)) {
            Storage::disk('public')->delete($promo->gambar);
        }

        // Delete the promo record from the database
        $promo->delete();

        // Redirect with success message
        return redirect()->route('dashboard.Promo.Promo')->with('success', 'Promo berhasil dihapus.');
    }

    public function update(Request $request, $id_promo)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000', // Validasi deskripsi dengan batas maksimum 1000 karakter
            'gambar_promo' => 'nullable|image|mimes:jpg,jpeg,png|max:10000', // Validasi gambar promo, maksimal 10MB
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
            $file->move(public_path('uploads/promos'), $filename);
            $promo->gambar_promo = $filename; // Simpan nama file ke database
        }

        // Simpan perubahan ke database
        $promo->save();

        // Redirect ke halaman promo dengan pesan sukses
        return redirect()->route('dashboard.Promo.Promo')->with('success', 'Promo berhasil diperbarui.');
    }

}
