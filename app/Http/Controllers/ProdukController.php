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

        // Jika biaya pasang kosong, set menjadi 0
        if (empty($biayaPasang)) {
            $biayaPasang = 0;
        }

        // Gabungkan kembali harga produk dan biaya pasang untuk validasi
        $request->merge(['harga_produk' => $hargaProduk, 'biaya_pasang' => $biayaPasang]);

        // Validasi data
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'benefit' => 'nullable|array', // Benefit sebagai array
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'biaya_pasang' => 'nullable|numeric|min:0',
            'kuota' => 'nullable|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
        ]);

        // Convert benefit array to JSON format
        $benefitJson = !empty($validated['benefit']) ? json_encode($validated['benefit']) : null;

        // Data produk yang akan disimpan
        $produkData = [
            'nama_produk' => $validated['nama_produk'],
            'harga_produk' => $validated['harga_produk'],
            'benefit' => $benefitJson, // Simpan sebagai JSON
            'kecepatan' => $validated['kecepatan'],
            'deskripsi' => $validated['deskripsi'],
            'diskon' => $validated['diskon'] ?? 0,
            'biaya_pasang' => $biayaPasang,
            'kuota' => $validated['kuota'] ?? null,
            'id_kategori' => $validated['id_kategori'],
            'id_paket' => $validated['id_paket'],
        ];

        // Simpan produk ke database
        try {
            Produk::create($produkData);
            return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id_produk)
    {
        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($id_produk);

        // Proses update jika method POST atau PUT
        if ($request->isMethod('post') || $request->isMethod('put')) {
            // Hapus titik pemisah ribuan dari input harga dan biaya pasang
            $hargaProduk = str_replace('.', '', $request->input('harga_produk'));
            $biayaPasang = str_replace('.', '', $request->input('biaya_pasang'));

            // Jika biaya pasang kosong, set sebagai 0
            if (empty($biayaPasang)) {
                $biayaPasang = 0;
            }

            // Gabungkan kembali harga produk dan biaya pasang untuk validasi
            $request->merge(['harga_produk' => $hargaProduk, 'biaya_pasang' => $biayaPasang]);

            // Validasi input
            $validatedData = $request->validate([
                'nama_produk' => 'required|string|max:255',
                'harga_produk' => 'required|numeric|min:0',
                'benefit' => 'nullable|array', // Benefit harus berupa array
                'kecepatan' => 'required|integer',
                'deskripsi' => 'required|string',
                'diskon' => 'nullable|numeric|min:0|max:100',
                'biaya_pasang' => 'nullable|numeric|min:0',
                'kuota' => 'nullable|integer|min:0',
                'id_kategori' => 'required|exists:kategori,id_kategori',
                'id_paket' => 'required|exists:paket,id_paket',
            ]);

            // Jika benefit tidak ada, beri nilai default array kosong
            $validatedData['benefit'] = json_encode($validatedData['benefit'] ?? []); // Encode as JSON

            // Simpan perubahan ke produk
            $produk->nama_produk = $validatedData['nama_produk'];
            $produk->harga_produk = $validatedData['harga_produk'];
            $produk->benefit = $validatedData['benefit']; // Simpan benefit sebagai JSON
            $produk->biaya_pasang = $validatedData['biaya_pasang'];
            $produk->kecepatan = $validatedData['kecepatan'];
            $produk->deskripsi = $validatedData['deskripsi'];
            $produk->diskon = $validatedData['diskon'];
            $produk->kuota = $validatedData['kuota'];
            $produk->id_kategori = $validatedData['id_kategori'];
            $produk->id_paket = $validatedData['id_paket'];

            // Simpan perubahan ke database
            $produk->save();

            // Redirect ke halaman produk dengan pesan sukses
            return redirect()->route('dashboard.dataProduk.dataProduk')->with('success', 'Produk berhasil diperbarui');
        }
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
