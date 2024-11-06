<?php

namespace App\Http\Controllers;

use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TentangKamiController extends Controller
{

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]); 

        

        // Simpan data ke database
        TentangKami::create([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
        ]);

        return redirect()->route('dashboard.tentangKami.layoutTentangKami')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tentangKami = TentangKami::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'deskripsi_perusahaan' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        // Update data di database
        $tentangKami->update([
            'deskripsi_perusahaan' => $validatedData['deskripsi_perusahaan'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
        ]);

        return redirect()->route('dashboard.tentangKami.layoutTentangKami')->with('success', 'Data berhasil diperbarui.');
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

        return redirect()->route('dashboard.tentangKami.layoutTentangKami')->with('success', 'Data berhasil dihapus.');
    }
}
