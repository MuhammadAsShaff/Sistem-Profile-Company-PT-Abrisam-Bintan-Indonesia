<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/kegiatan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1416, 780, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Simpan nama file gambar ke dalam array validated
            $validated['gambar'] = $filename;
        }

        // Simpan data kegiatan ke database
        Kegiatan::create($validated);

        // Redirect ke halaman kegiatan dengan pesan sukses
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

            // Simpan gambar baru menggunakan Intervention Image
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/kegiatan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1416, 780, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar yang baru ke dalam validated array
            $validated['gambar'] = $filename;
        }

        // Update data kegiatan
        $kegiatan->update($validated);

        // Redirect dengan pesan sukses
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
