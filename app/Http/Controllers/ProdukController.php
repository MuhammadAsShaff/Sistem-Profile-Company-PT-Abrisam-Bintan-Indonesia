<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Paket;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        session(['previous_url' => url()->full()]);

        $search = $request->input('search');
        $query = Produk::orderBy('updated_at', 'desc');

        if (!empty($search)) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        $produks = $query->paginate(5);
        $kategoris = Kategori::all();
        $pakets = Paket::all();

        return view('dashboard.dataProduk.dataProduk', compact('produks', 'search', 'kategoris', 'pakets'));
    }

    public function store(Request $request)
    {
        // Hapus titik pemisah ribuan dari input harga dan biaya pasang
        $hargaProduk = str_replace('.', '', $request->input('harga_produk'));
        $biayaPasang = str_replace('.', '', $request->input('biaya_pasang'));
        $request->merge(['harga_produk' => $hargaProduk, 'biaya_pasang' => $biayaPasang]);

        // Validasi data
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'benefit' => 'nullable|string',
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'biaya_pasang' => 'nullable|numeric|min:0', // Validasi biaya pasang
            'kuota' => 'nullable|integer|min:0', // Validasi kuota, bisa diisi atau kosong
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
        ]);

        // Persiapan data produk baru
        $produkData = [
            'nama_produk' => $request->input('nama_produk'),
            'harga_produk' => $validated['harga_produk'], // Simpan harga produk yang sudah diformat
            'benefit' => $request->input('benefit'),
            'kecepatan' => $request->input('kecepatan'),
            'deskripsi' => $request->input('deskripsi'),
            'diskon' => $request->input('diskon'),
            'biaya_pasang' => $request->input('biaya_pasang') ?: 0, // Jika kosong, simpan 0
            'kuota' => $request->input('kuota') ?: null, // Jika kosong, simpan null atau 0 sesuai kebutuhan
            'id_kategori' => $request->input('id_kategori'),
            'id_paket' => $request->input('id_paket'),
        ];

        // Insert produk ke database
        try {
            Produk::create($produkData);
            return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id_produk)
    {
        // Hapus titik pemisah ribuan dari input harga dan biaya pasang
        $hargaProduk = str_replace('.', '', $request->input('harga_produk'));
        $biayaPasang = str_replace('.', '', $request->input('biaya_pasang'));

        // Gabungkan kembali harga produk dan biaya pasang untuk validasi
        $request->merge(['harga_produk' => $hargaProduk, 'biaya_pasang' => $biayaPasang]);

        // Validasi input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0', // Pastikan harga adalah angka setelah penghapusan titik
            'benefit' => 'nullable|string',
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100000',
            'biaya_pasang' => 'nullable|numeric|min:0', // Validasi biaya pasang
            'kuota' => 'nullable|integer|min:0', // Validasi kuota
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
        ]);

        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($id_produk);

        // Update data produk dengan data yang divalidasi
        $produk->nama_produk = $validatedData['nama_produk'];
        $produk->harga_produk = $validatedData['harga_produk'];
        $produk->benefit = $validatedData['benefit'];
        $produk->kecepatan = $validatedData['kecepatan'];
        $produk->deskripsi = $validatedData['deskripsi'];
        $produk->diskon = $validatedData['diskon'];
        $produk->biaya_pasang = $validatedData['biaya_pasang']; // Update biaya pasang
        $produk->kuota = $validatedData['kuota']; // Update kuota
        $produk->id_kategori = $validatedData['id_kategori'];
        $produk->id_paket = $validatedData['id_paket'];

        // Simpan perubahan ke database
        $produk->save();

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus produk
        $produk->delete();

        // Redirect setelah dihapus
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil dihapus');
    }
}
