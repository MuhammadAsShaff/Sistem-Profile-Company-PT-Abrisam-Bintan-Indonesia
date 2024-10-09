<?php

namespace App\Http\Controllers;

use App\Models\FaQ;
use Illuminate\Http\Request;

class FaQController extends Controller
{
    // Menampilkan daftar FAQ
    public function index(Request $request)
    {
        // Simpan URL terakhir ke session sebelum mengunjungi halaman index
        session(['previous_url' => request()->fullUrl()]);

        // Ambil query pencarian
        $search = $request->input('search');

        // Query dasar untuk mengambil semua FAQ
        $query = FaQ::query();

        // Filter berdasarkan pencarian judul FAQ
        if (!empty($search)) {
            $query->where('judul_faq', 'like', '%' . $search . '%');
        }

        // Lakukan paginasi dengan limit 5
        $faqs = $query->paginate(5);

        $FaQCount = FaQ::count();

        // Kirim data ke view
        return view('dashboard.FaQ.FaQ', compact('faqs', 'FaQCount','search'));
    }

    // Menampilkan detail isi FAQ berdasarkan ID
    public function show($id_faq)
    {
        // Ambil FAQ berdasarkan ID
        $faq = FaQ::findOrFail($id_faq);

        return response()->json($faq); // Kirim data FAQ sebagai response JSON
    }

    // Menyimpan FAQ baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_faq' => 'required|string|max:255',
            'isi_faq' => 'required|string',
        ]);

        // Persiapan data FAQ baru
        $faqData = [
            'judul_faq' => $request->input('judul_faq'),
            'isi_faq' => $request->input('isi_faq'),
        ];

        // Simpan data FAQ ke database
        FaQ::create($faqData);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.FaQ.FaQ')->with('success', 'FAQ berhasil ditambahkan.');
    }

    // Menghapus FAQ berdasarkan ID
    public function destroy($id_faq)
    {
        // Temukan FAQ berdasarkan ID
        $faq = FaQ::find($id_faq);

        // Cek apakah FAQ ditemukan
        if (!$faq) {
            return redirect()->back()->with('error', 'FAQ tidak ditemukan.');
        }

        // Hapus FAQ
        $faq->delete();

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->route('dashboard.FaQ.FaQ')->with('success', 'FAQ berhasil dihapus.');
    }

    // Mengupdate FAQ berdasarkan ID
    public function update(Request $request, $id_faq)
    {
        // Validasi input
        $request->validate([
            'judul_faq' => 'required|string|max:255',
            'isi_faq' => 'required|string',
        ]);

        // Ambil FAQ berdasarkan ID
        $faq = FaQ::find($id_faq);

        // Update data FAQ
        $faq->judul_faq = $request->input('judul_faq');
        $faq->isi_faq = $request->input('isi_faq');

        // Simpan perubahan
        $faq->save();

        return redirect()->route('dashboard.FaQ.FaQ')->with('success', 'FAQ berhasil diupdate.');
    }
}
