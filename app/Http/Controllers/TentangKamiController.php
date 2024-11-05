<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangKamiController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data Tentang Kami untuk ditampilkan
        $tentangKami = TentangKami::all();
        return view('dashboard.tentangKami.index', compact('tentangKami'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gambar_kegiatan.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi untuk gambar
        ]);

        // Simpan gambar kegiatan jika ada
        $gambarKegiatan = [];
        if ($request->hasFile('gambar_kegiatan')) {
            foreach ($request->file('gambar_kegiatan') as $gambar) {
                $filename = time() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('public/uploads/kegiatan', $filename);
                $gambarKegiatan[] = $filename;
            }
        }

        // Simpan data ke database
        TentangKami::create([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            'gambar_kegiatan' => json_encode($gambarKegiatan), // Simpan sebagai JSON
        ]);

        return redirect()->route('dashboard.tentangKami.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tentangKami = TentangKami::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gambar_kegiatan.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update gambar kegiatan jika ada
        $gambarKegiatan = json_decode($tentangKami->gambar_kegiatan, true) ?? [];
        if ($request->hasFile('gambar_kegiatan')) {
            foreach ($request->file('gambar_kegiatan') as $gambar) {
                $filename = time() . '_' . $gambar->getClientOriginalName();
                $gambar->storeAs('public/uploads/kegiatan', $filename);
                $gambarKegiatan[] = $filename;
            }
        }

        // Update data di database
        $tentangKami->update([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
            'gambar_kegiatan' => json_encode($gambarKegiatan), // Update gambar kegiatan
        ]);

        return redirect()->route('dashboard.tentangKami.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tentangKami = TentangKami::findOrFail($id);

        // Hapus gambar dari storage jika ada
        $gambarKegiatan = json_decode($tentangKami->gambar_kegiatan, true) ?? [];
        foreach ($gambarKegiatan as $gambar) {
            Storage::delete('public/uploads/kegiatan/' . $gambar);
        }

        // Hapus data dari database
        $tentangKami->delete();

        return redirect()->route('dashboard.tentangKami.index')->with('success', 'Data berhasil dihapus.');
    }
}
