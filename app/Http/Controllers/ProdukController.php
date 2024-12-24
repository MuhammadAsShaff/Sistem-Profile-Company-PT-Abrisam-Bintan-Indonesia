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

        $kategori = $request->input('kategori');
        $search = $request->input('search');

        // Query dasar dengan eager loading relasi
        $query = Produk::with(['kategori', 'paket'])
            ->orderBy('updated_at', 'desc');

        // Filter berdasarkan pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($subQuery) use ($search) {
                        $subQuery->where('nama_kategori', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('paket', function ($subQuery) use ($search) {
                        $subQuery->where('nama_paket', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter berdasarkan kategori
        if (!empty($kategori)) {
            $query->whereHas('kategori', function ($q) use ($kategori) {
                $q->where('nama_kategori', $kategori);
            });
        }

        // Ambil data untuk dropdown kategori
        $kategoriSearch = Kategori::distinct()->pluck('nama_kategori')->filter()->toArray();

        // Paginate hasil query
        $produks = $query->paginate(5);

        // Ambil data tambahan
        $kategoris = Kategori::all();
        $pakets = Paket::all();

        return view('dashboard.dataProduk.dataProduk', compact(
            'produks',
            'search',
            'kategoris',
            'pakets',
            'kategoriSearch',
            'kategori'
        ));
    }

    public function store(Request $request)
    {
        // Remove thousand separators from 'harga_produk' and 'biaya_pasang' inputs for validation
        $hargaProduk = str_replace('.', '', $request->input('harga_produk'));
        $biayaPasang = str_replace('.', '', $request->input('biaya_pasang'));

        // Set default for 'biaya_pasang' if empty
        if (empty($biayaPasang)) {
            $biayaPasang = 0;
        }

        // Merge processed values back into the request
        $request->merge([
            'harga_produk' => $hargaProduk,
            'biaya_pasang' => $biayaPasang
        ]);

        // Validasi input termasuk benefit
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

        // Proses 'benefit' menjadi array JSON
        $benefitJson = !empty($validated['benefit']) ? json_encode($validated['benefit']) : null;

        // Data produk yang akan disimpan
        $produkData = [
            'nama_produk' => $validated['nama_produk'],
            'harga_produk' => $validated['harga_produk'],
            'benefit' => $benefitJson, // Simpan 'benefit' sebagai JSON
            'kecepatan' => $validated['kecepatan'],
            'deskripsi' => $validated['deskripsi'],
            'diskon' => $validated['diskon'] ?? 0, // Default ke 0 jika tidak diberikan
            'biaya_pasang' => $biayaPasang, // Sudah di-set ke 0 jika kosong
            'kuota' => $validated['kuota'] ?? null, // Default ke null jika tidak diberikan
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

        // Validasi input termasuk benefit
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'benefit' => 'nullable|string', // Benefit sebagai string
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'biaya_pasang' => 'nullable|numeric|min:0',
            'kuota' => 'nullable|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
        ]);

        // Proses input benefit: menghapus angka yang ada pada setiap baris
        $benefitArray = !empty($validated['benefit'])
            ? preg_replace('/^\d+\.\s*/m', '', explode("\n", $validated['benefit'])) // Menghapus angka di awal baris
            : [];

        // Encode sebagai JSON
        $validated['benefit'] = json_encode($benefitArray);

        // Update data produk
        $produk->update([
            'nama_produk' => $validated['nama_produk'],
            'harga_produk' => $validated['harga_produk'],
            'benefit' => $validated['benefit'], // Simpan benefit tanpa angka
            'kecepatan' => $validated['kecepatan'],
            'deskripsi' => $validated['deskripsi'],
            'diskon' => $validated['diskon'],
            'biaya_pasang' => $validated['biaya_pasang'],
            'kuota' => $validated['kuota'],
            'id_kategori' => $validated['id_kategori'],
            'id_paket' => $validated['id_paket'],
        ]);

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
