<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|mimes:jpg,jpeg,png|max:10000',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $validated['gambar'] = $filename;
        }

        // Simpan data kegiatan ke database
        Kegiatan::create($validated);

        return redirect()->route('dashboard.tentangKami.layoutTentangKami')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Temukan kegiatan berdasarkan ID
        $kegiatan = Kegiatan::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|mimes:jpg,jpeg,png|max:10000',
        ]);

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kegiatan->gambar && file_exists(public_path('uploads/kegiatan/' . $kegiatan->gambar))) {
                unlink(public_path('uploads/kegiatan/' . $kegiatan->gambar));
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kegiatan'), $filename);
            $validated['gambar'] = $filename;
        }

        // Update data kegiatan
        $kegiatan->update($validated);

        return redirect()->route('dashboard.tentangKami.layoutTentangKami')->with('success', 'Kegiatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Hapus gambar kegiatan jika ada
        if ($kegiatan->gambar && file_exists(public_path('uploads/kegiatan/' . $kegiatan->gambar))) {
            unlink(public_path('uploads/kegiatan/' . $kegiatan->gambar));
        }

        // Hapus data kegiatan
        $kegiatan->delete();

        return redirect()->route('dashboard.tentangKami.layoutTentangKami')->with('success', 'Kegiatan berhasil dihapus');
    }
}
