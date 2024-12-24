<?php

namespace App\Http\Controllers;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TentangKamiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string|max:1000',
            'visi' => 'required|string|max:1000',
            'misi' => 'required|string|max:1000',
            'fotoPerusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000', // Validasi gambar
        ]);

        $fotoPerusahaan = null;

        // Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('fotoPerusahaan')) {
            $file = $request->file('fotoPerusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/fotoPerusahaan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1350, 1020, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $fotoPerusahaan = $filename;
        }

        // Simpan data ke database
        TentangKami::create([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            'fotoPerusahaan' => $fotoPerusahaan,
        ]);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        // Temukan data tentang kami berdasarkan ID
        $tentangKami = TentangKami::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string|max:1000',
            'visi' => 'required|string|max:1000',
            'misi' => 'required|string|max:1000',
            'fotoPerusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        // Cek jika ada file gambar yang di-upload
        if ($request->hasFile('fotoPerusahaan')) {
            // Hapus file lama jika ada
            if ($tentangKami->fotoPerusahaan && file_exists(public_path('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan))) {
                unlink(public_path('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan));
            }

            // Ambil file gambar yang baru
            $file = $request->file('fotoPerusahaan');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/fotoPerusahaan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1350, 1020, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $tentangKami->fotoPerusahaan = $filename;
        }

        // Update data ke database
        $tentangKami->update([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            'fotoPerusahaan' => $tentangKami->fotoPerusahaan, // Menyimpan nama file gambar yang baru
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $tentangKami = TentangKami::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($tentangKami->fotoPerusahaan && file_exists(public_path('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan))) {
            unlink(public_path('uploads/fotoPerusahaan/' . $tentangKami->fotoPerusahaan));
        }

        // Hapus data dari database
        $tentangKami->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
