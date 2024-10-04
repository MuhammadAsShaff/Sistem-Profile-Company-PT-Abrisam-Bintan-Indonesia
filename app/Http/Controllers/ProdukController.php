<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Paket;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // Hapus titik pemisah ribuan dari input harga
        $hargaProduk = str_replace('.', '', $request->input('harga_produk'));
        $request->merge(['harga_produk' => $hargaProduk]);

        // Cek apakah ada kategori dan paket
        $kategoris = Kategori::all(); // Ambil semua kategori
        $pakets = Paket::all(); // Ambil semua paket

        // Validasi data
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'benefit' => 'required|string',
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
            'gambar_produk' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Pastikan kategori dan paket tersedia
        if ($kategoris->isEmpty() || $pakets->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada kategori atau paket yang tersedia. Silakan tambahkan kategori dan paket terlebih dahulu.');
        }

        // Persiapan data produk baru
        $produkData = [
            'nama_produk' => $request->input('nama_produk'),
            'harga_produk' => $validated['harga_produk'],
            'benefit' => $request->input('benefit'),
            'kecepatan' => $request->input('kecepatan'),
            'deskripsi' => $request->input('deskripsi'),
            'diskon' => $request->input('diskon'),
            'id_kategori' => $request->input('id_kategori'),
            'id_paket' => $request->input('id_paket'),
        ];

        // Cek apakah ada file yang diupload
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/produk');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $produkData['gambar_produk'] = $filename; // Menyimpan nama file gambar
        }

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
        // Hapus titik pemisah ribuan dari input harga
        $hargaProduk = str_replace('.', '', $request->input('harga_produk'));

        // Gabungkan kembali harga produk yang sudah dihapus titiknya untuk validasi
        $request->merge(['harga_produk' => $hargaProduk]);

        // Validasi input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0', // Pastikan harga adalah angka setelah penghapusan titik
            'benefit' => 'required|string',
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100000',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
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
        $produk->id_kategori = $validatedData['id_kategori'];
        $produk->id_paket = $validatedData['id_paket'];

        // Update gambar jika ada
        if ($request->hasFile('gambar_produk')) {
            if ($produk->gambar_produk && file_exists(public_path('uploads/produk/' . $produk->gambar_produk))) {
                unlink(public_path('uploads/produk/' . $produk->gambar_produk));
            }

            $file = $request->file('gambar_produk');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/produk'), $filename);
            $produk->gambar_produk = $filename;
        }

        // Simpan perubahan ke database
        $produk->save();

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file gambar jika ada
        if ($produk->gambar_produk) {
            Storage::delete('public/uploads/produk/' . $produk->gambar_produk);
        }

        // Hapus produk
        $produk->delete();

        // Redirect setelah dihapus
        return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil dihapus');
    }
}
