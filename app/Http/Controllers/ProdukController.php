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
        // Remove non-numeric characters
        $hargaProduk = preg_replace('/[^0-9]/', '', $request->input('harga_produk'));
        $biayaPasang = preg_replace('/[^0-9]/', '', $request->input('biaya_pasang') ?: '0');

        $request->merge([
            'harga_produk' => $hargaProduk,
            'biaya_pasang' => $biayaPasang,
        ]);

        // Validasi input
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'benefit' => 'nullable|array',
            'kecepatan' => 'required|integer',
            'deskripsi' => 'required|string',
            'diskon' => 'nullable|numeric|min:0|max:100',
            'biaya_pasang' => 'nullable|numeric|min:0',
            'kuota' => 'nullable|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_paket' => 'required|exists:paket,id_paket',
        ]);

        $benefitJson = !empty($validated['benefit']) ? json_encode($validated['benefit']) : null;

        $produkData = [
            'nama_produk' => $validated['nama_produk'],
            'harga_produk' => $validated['harga_produk'],
            'benefit' => $benefitJson,
            'kecepatan' => $validated['kecepatan'],
            'deskripsi' => $validated['deskripsi'],
            'diskon' => $validated['diskon'] ?? 0,
            'biaya_pasang' => $biayaPasang,
            'kuota' => $validated['kuota'] ?? null,
            'id_kategori' => $validated['id_kategori'],
            'id_paket' => $validated['id_paket'],
        ];

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

        // Hapus semua karakter non-numeric dari input harga_produk dan biaya_pasang
        $request->merge([
            'harga_produk' => preg_replace('/[^0-9]/', '', $request->input('harga_produk')),
            'biaya_pasang' => preg_replace('/[^0-9]/', '', $request->input('biaya_pasang') ?: '0'),
        ]);

        // Validasi input
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

        // Proses benefit: Hapus nomor di awal setiap baris dan encode sebagai JSON
        $benefitArray = !empty($validated['benefit'])
            ? preg_replace('/^\d+\.\s*/m', '', explode("\n", $validated['benefit'])) // Hapus angka di awal baris
            : [];
        $validated['benefit'] = json_encode($benefitArray);

        // Update data produk
        $produk->update([
            'nama_produk' => $validated['nama_produk'],
            'harga_produk' => $validated['harga_produk'], // Simpan harga sebagai angka
            'benefit' => $validated['benefit'], // Simpan benefit sebagai JSON
            'kecepatan' => $validated['kecepatan'],
            'deskripsi' => $validated['deskripsi'],
            'diskon' => $validated['diskon'],
            'biaya_pasang' => $validated['biaya_pasang'], // Simpan biaya pasang sebagai angka
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
