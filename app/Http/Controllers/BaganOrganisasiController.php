<?php

namespace App\Http\Controllers;

use App\Models\BaganOrganisasi;
use App\Models\TentangKami;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BaganOrganisasiController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel BaganOrganisasi
        $data = BaganOrganisasi::all();

        // Mengambil hanya satu record dari TentangKami
        $tentangKami = TentangKami::first(); // Ambil record pertama saja

        // Mengambil data untuk dropdown parent options
        $parentOptions = BaganOrganisasi::all();

        // Mengambil data kegiatan untuk dropdown parent options
        $kegiatan = Kegiatan::all();

        // Memetakan data menjadi format yang sesuai untuk digunakan pada organigram
        $nodes = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'pid' => $item->parent_id,
                'name' => $item->name,
                'title' => $item->title,
                'img' => $item->img_url ? asset('uploads/bagan/' . $item->img_url) : null,
            ];
        });

        // Mengirimkan data ke view
        return view('dashboard.tentangKami.layoutTentangKami', [
            'nodes' => $nodes->isEmpty() ? '[]' : $nodes->toJson(),
            'parentOptions' => $parentOptions,
            'countNode' => $nodes->count(),
            'tentangKami' => $tentangKami, // Mengirim satu instance TentangKami ke view
            'kegiatan' => $kegiatan
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'img_file' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'parent_id' => 'nullable|exists:bagan,id'
        ]);

        $imgFilename = null;

        // Cek apakah ada gambar yang di-upload
        if ($request->hasFile('img_file')) {
            $file = $request->file('img_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/bagan');
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
            $imgFilename = $filename;
        }

        // Simpan data ke database
        BaganOrganisasi::create([
            'name' => $validated['name'],
            'title' => $validated['title'],
            'img_url' => $imgFilename,  // Menyimpan nama file gambar
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        // Lakukan redirect langsung ke halaman `dashboard.tentangKami.layoutTentangKami`
        return redirect()->route('dashboard.tentangKami.layoutTentangKami')
            ->with('success', 'Node berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'img_file' => 'nullable|mimes:jpg,jpeg,png|max:2048' // Tambahkan validasi gambar
        ]);

        $position = BaganOrganisasi::findOrFail($id);

        // Cek apakah ada gambar yang di-upload
        if ($request->hasFile('img_file')) {
            $file = $request->file('img_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Buat direktori jika belum ada
            $destinationPath = public_path('uploads/bagan');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Hapus gambar lama jika ada
            if ($position->img_url && file_exists(public_path('uploads/bagan/' . $position->img_url))) {
                unlink(public_path('uploads/bagan/' . $position->img_url));
            }

            // Menggunakan Intervention Image untuk resize dan crop gambar
            $image = Image::make($file); // Membuka file gambar
            $image->fit(1080, 1080, function ($constraint) {
                $constraint->upsize(); // Mencegah gambar diperbesar lebih besar dari ukuran aslinya
            });

            // Simpan gambar yang sudah di-resize dan di-crop
            $image->save($destinationPath . '/' . $filename);

            // Menyimpan nama file gambar
            $validated['img_url'] = $filename;
        }

        // Perbarui data teks (nama dan jabatan)
        $position->update([
            'name' => $validated['name'],
            'title' => $validated['title'],
            'img_url' => $validated['img_url'] ?? $position->img_url // Simpan gambar baru jika ada, atau tetap gunakan gambar lama
        ]);

        return response()->json([
            'message' => 'Bagan berhasil diperbarui',
            'redirect' => route('dashboard.tentangKami.layoutTentangKami')
        ]);
    }

    public function destroy($id)
    {
        $position = BaganOrganisasi::findOrFail($id);

        // Jika parent_id kosong, hapus semua data di tabel
        if (is_null($position->parent_id)) {
            $allPositions = BaganOrganisasi::all();

            foreach ($allPositions as $pos) {
                // Hapus file gambar jika ada
                if (!empty($pos->img_url)) {  // Memastikan img_url tidak kosong
                    $filePath = public_path('uploads/bagan/' . $pos->img_url);

                    // Periksa apakah file benar-benar ada sebelum menghapusnya
                    if (file_exists($filePath)) {
                        unlink($filePath); // Menghapus file gambar
                    }
                }
            }

            // Hapus semua data di tabel
            BaganOrganisasi::truncate();

            return response()->json([
                'message' => 'Semua data berhasil dihapus',
                'redirect' => route('dashboard.tentangKami.layoutTentangKami')
            ]);
        }

        // Hapus file gambar jika ada
        if (!empty($position->img_url)) {  // Memastikan img_url tidak kosong
            $filePath = public_path('uploads/bagan/' . $position->img_url);

            // Periksa apakah file benar-benar ada sebelum menghapusnya
            if (file_exists($filePath)) {
                unlink($filePath); // Menghapus file gambar
            }
        }

        // Hapus node dari database
        $position->delete();

        // Kirim URL redirect dalam respons JSON
        return response()->json([
            'message' => 'Node berhasil dihapus',
            'redirect' => route('dashboard.tentangKami.layoutTentangKami')
        ]);
    }
}
