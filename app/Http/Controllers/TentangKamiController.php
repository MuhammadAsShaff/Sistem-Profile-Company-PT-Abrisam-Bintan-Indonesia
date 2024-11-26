<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangKamiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string|max:1000',
            'visi' => 'required|string|max:1000',
            'misi' => 'required|string|max:1000',
            'fotoPerusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPerusahaan = null;
        if ($request->hasFile('fotoPerusahaan')) {
            $file = $request->file('fotoPerusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/fotoPerusahaan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Simpan file ke direktori
            $file->move($destinationPath, $filename);
            $fotoPerusahaan = $filename;
        }

        // Simpan data ke database
        TentangKami::create([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            'fotoPerusahaan' => $fotoPerusahaan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tentangKami = TentangKami::findOrFail($id);

        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string|max:1000',
            'visi' => 'required|string|max:1000',
            'misi' => 'required|string|max:1000',
            'fotoPerusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('fotoPerusahaan')) {
            // Hapus file lama jika ada
            if ($tentangKami->fotoPerusahaan && file_exists(public_path('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan))) {
                unlink(public_path('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan));
            }

            // Simpan file baru
            $file = $request->file('fotoPerusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/fotoPerusahaan'), $filename);
            $tentangKami->fotoPerusahaan = $filename;
        }

        $tentangKami->update([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            'fotoPerusahaan' => $tentangKami->fotoPerusahaan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tentangKami = TentangKami::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($tentangKami->fotoPerusahaan) {
            Storage::disk('public')->delete($tentangKami->fotoPerusahaan);
        }

        // Hapus data dari database
        $tentangKami->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
