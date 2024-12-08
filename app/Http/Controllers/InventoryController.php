<?php
namespace App\Http\Controllers;
use App\Models\InventoryKeluar;
use App\Models\InventoryMasuk;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function showInventoryMasuk()
    {
        // Ambil data inventory masuk dengan relasi ke stocks dan pagination
        $inventoryMasuk = InventoryMasuk::with('stocks')->paginate(10);

        // Hitung jumlah stok berdasarkan kategoriProduk
        $jumlahStockMasukPerKategori = Stock::select('kategoriProduk', \DB::raw('COUNT(id_inventoryMasuk) as jumlah'))
            ->groupBy('kategoriProduk')
            ->get();

        // Ambil semua data stok
        $stok = Stock::all();

        return view('dashboard.inventory.inventoryMasuk.inventoryMasuk', [
            'inventoryMasuk' => $inventoryMasuk,
            'jumlahStockMasukPerKategori' => $jumlahStockMasukPerKategori,
            'stok' => $stok,
        ]);
    }



    public function showInventoryKeluar()
    {
        // Ambil data Inventory Keluar dengan relasi ke stocks dan pagination
        $inventoryKeluar = InventoryKeluar::with('stocks')->paginate(10);

        // Hitung jumlah stok keluar berdasarkan kategoriProduk
        $jumlahStockKeluarPerKategori = Stock::select('kategoriProduk', \DB::raw('COUNT(id_inventoryKeluar) as jumlah'))
            ->whereNotNull('id_inventoryKeluar')
            ->groupBy('kategoriProduk')
            ->get();

        // Ambil semua data stok
        $stok = Stock::all();

        return view('dashboard.inventory.inventoryKeluar.inventoryKeluar', [
            'inventoryKeluar' => $inventoryKeluar,
            'jumlahStockKeluarPerKategori' => $jumlahStockKeluarPerKategori,
            'stok' => $stok,
        ]);
    }





    // Method untuk Insert Inventory Masuk
    public function insertInventoryMasuk(Request $request)
    {
        $validatedData = $request->validate([
            'kategoriProduk' => 'required|string|unique:inventory_masuk,kategoriProduk',
        ]);

        // Ubah kategoriProduk menjadi format kapital pertama (ucwords)
        $kategoriProduk = ucwords(strtolower($validatedData['kategoriProduk']));

        // Tambahkan data ke Inventory Masuk
        $inventoryMasuk = InventoryMasuk::create([
            'kategoriProduk' => $kategoriProduk,
        ]);

        // Periksa jika kategori sudah ada di InventoryKeluar
        if (!InventoryKeluar::where('kategoriProduk', $kategoriProduk)->exists()) {
            InventoryKeluar::create([
                'kategoriProduk' => $kategoriProduk,
            ]);
        }

        return redirect()->route('inventoryMasuk')->with('success', 'Inventory Masuk berhasil ditambahkan.');
    }


    public function updateInventoryMasuk(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kategoriProduk' => 'required|string',
        ]);

        // Ambil data Inventory Masuk berdasarkan ID
        $inventoryMasuk = InventoryMasuk::findOrFail($id);

        // Ambil kategoriProduk sebelum diubah
        $oldKategoriProduk = $inventoryMasuk->kategoriProduk;

        // Perbarui kategoriProduk di Inventory Masuk
        $inventoryMasuk->update([
            'kategoriProduk' => $validatedData['kategoriProduk'],
        ]);

        // Cari data di InventoryKeluar berdasarkan kategoriProduk lama
        $inventoryKeluar = InventoryKeluar::where('kategoriProduk', $oldKategoriProduk)->first();

        if ($inventoryKeluar) {
            // Perbarui kategoriProduk di Inventory Keluar
            $inventoryKeluar->update([
                'kategoriProduk' => $validatedData['kategoriProduk'],
            ]);
        } else {
            return redirect()->route('inventoryMasuk')->with('error', 'Kategori produk lama tidak ditemukan di Inventory Keluar.');
        }

        // Perbarui kategoriProduk di tabel Stock
        $stocks = Stock::where('kategoriProduk', $oldKategoriProduk)->get();
        foreach ($stocks as $stock) {
            $stock->update([
                'kategoriProduk' => $validatedData['kategoriProduk'],
            ]);
        }

        // Kembali ke halaman Inventory Masuk dengan pesan sukses
        return redirect()->route('inventoryMasuk')->with('success', 'Inventory Masuk, Inventory Keluar, dan Stock berhasil diperbarui.');
    }

    public function updateInventoryKeluar(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'kategoriProduk' => 'required|string',
            ]);

            // Ambil data Inventory Keluar berdasarkan ID
            $inventoryKeluar = InventoryKeluar::findOrFail($id);

            // Log sebelum proses pembaruan
            Log::info('Memperbarui Inventory Keluar ID: ' . $id . ' Kategori Lama: ' . $inventoryKeluar->kategoriProduk);

            // Ambil kategoriProduk sebelum diubah
            $oldKategoriProduk = $inventoryKeluar->kategoriProduk;

            // Perbarui kategoriProduk di Inventory Keluar
            $inventoryKeluar->update([
                'kategoriProduk' => $validatedData['kategoriProduk'],
            ]);

            // Cari data di Inventory Masuk berdasarkan kategoriProduk lama
            $inventoryMasuk = InventoryMasuk::where('kategoriProduk', $oldKategoriProduk)->first();

            if ($inventoryMasuk) {
                // Log jika ditemukan Inventory Masuk
                Log::info('Memperbarui Inventory Masuk terkait dengan kategori lama: ' . $oldKategoriProduk);

                // Perbarui kategoriProduk di Inventory Masuk
                $inventoryMasuk->update([
                    'kategoriProduk' => $validatedData['kategoriProduk'],
                ]);
            }

            // Perbarui kategoriProduk di tabel Stock
            $stocks = Stock::where('kategoriProduk', $oldKategoriProduk)->get();
            foreach ($stocks as $stock) {
                $stock->update([
                    'kategoriProduk' => $validatedData['kategoriProduk'],
                ]);
            }

            return redirect()->route('inventoryKeluar')->with('success', 'Inventory Keluar, Inventory Masuk, dan Stock berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error saat memperbarui Inventory Keluar: ' . $e->getMessage());
            return redirect()->route('inventoryKeluar')->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }



    public function deleteInventory(Request $request, $id)
    {
        try {
            // Cari Inventory Masuk berdasarkan ID
            $inventoryMasuk = InventoryMasuk::findOrFail($id);

            // Simpan kategori produk untuk pencarian di InventoryKeluar
            $kategoriProduk = $inventoryMasuk->kategoriProduk;

            // Hapus semua stock terkait dengan Inventory Masuk
            Stock::where('id_inventoryMasuk', $inventoryMasuk->id_inventoryMasuk)->delete();

            // Hapus Inventory Masuk
            $inventoryMasuk->delete();

            // Cari dan hapus Inventory Keluar dengan kategori produk yang sama
            $inventoryKeluar = InventoryKeluar::where('kategoriProduk', $kategoriProduk)->first();
            if ($inventoryKeluar) {
                // Hapus semua stock terkait dengan Inventory Keluar
                Stock::where('id_inventoryKeluar', $inventoryKeluar->id_inventoryKeluar)->delete();
                $inventoryKeluar->delete();
            }

            return redirect()->route('inventoryMasuk')->with('success', 'Inventory Masuk, Inventory Keluar, dan Stock terkait berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('inventoryMasuk')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function deleteInventoryKeluar(Request $request, $id)
    {
        try {
            // Cari Inventory Keluar berdasarkan ID
            $inventoryKeluar = InventoryKeluar::findOrFail($id);

            // Log kategori produk untuk memastikan data valid
            Log::info('Menghapus Inventory Keluar dengan ID: ' . $id . ' dan kategori: ' . $inventoryKeluar->kategoriProduk);

            // Simpan kategori produk untuk pencarian di InventoryMasuk
            $kategoriProduk = $inventoryKeluar->kategoriProduk;

            // Hapus semua stock terkait dengan Inventory Keluar
            Stock::where('id_inventoryKeluar', $inventoryKeluar->id_inventoryKeluar)->delete();

            // Hapus Inventory Keluar
            $inventoryKeluar->delete();

            // Cari dan hapus Inventory Masuk dengan kategori produk yang sama
            $inventoryMasuk = InventoryMasuk::where('kategoriProduk', $kategoriProduk)->first();
            if ($inventoryMasuk) {
                // Log jika Inventory Masuk ditemukan
                Log::info('Menghapus Inventory Masuk terkait dengan kategori: ' . $kategoriProduk);

                // Hapus semua stock terkait dengan Inventory Masuk
                Stock::where('id_inventoryMasuk', $inventoryMasuk->id_inventoryMasuk)->delete();
                $inventoryMasuk->delete();
            }

            return redirect()->route('inventoryKeluar')->with('success', 'Inventory Keluar, Inventory Masuk, dan Stock terkait berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error saat menghapus Inventory Keluar: ' . $e->getMessage());
            return redirect()->route('inventoryKeluar')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }



    public function storeStock(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nomorProduk' => 'required|max:255',
            'keterangan' => 'nullable|max:255',
            'id_inventoryMasuk' => 'required|integer|exists:inventory_masuk,id_inventoryMasuk',
            'kategoriProduk' => 'nullable|string|max:255',
        ]);

        // Insert data ke tabel stock
        foreach ($request->nomorProduk as $index => $nomorProduk) {
            Stock::create([
                'kategoriProduk' => $request->kategoriProduk, // Pastikan kategoriProduk dikirim
                'nomorProduk' => $nomorProduk,
                'keterangan' => $request->keterangan[$index] ?? null,
                'id_inventoryMasuk' => $request->id_inventoryMasuk,
                'id_inventoryKeluar' => null, // Kosongkan id_inventoryKeluar
            ]);
        }

        // Mengarahkan kembali ke halaman yang sama setelah data berhasil disimpan
        return redirect()->route('inventoryMasuk')->with('success', 'Data produk berhasil ditambahkan!');
    }



    public function pindahkanProdukMassal(Request $request)
    {
        $ids = $request->input('ids');

        // Validasi input
        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
        }

        // Pindahkan produk satu per satu
        $stocks = Stock::whereIn('id_stock', $ids)->get();

        foreach ($stocks as $stock) {
            // Pastikan kategori produk memiliki InventoryKeluar terkait
            $inventoryKeluar = InventoryKeluar::where('kategoriProduk', $stock->kategoriProduk)->first();

            if (!$inventoryKeluar) {
                return redirect()->back()->with('error', 'Inventory Keluar untuk kategori ini belum tersedia.');
            }

            // Pindahkan stok
            $stock->id_inventoryMasuk = null;
            $stock->id_inventoryKeluar = $inventoryKeluar->id_inventoryKeluar;
            $stock->save();
        }

        return redirect()->back()->with('success', 'Produk berhasil dipindahkan.');
    }

    public function pindahkanProdukKeluar(Request $request)
    {
        try {
            // Ambil ID stock dari checkbox
            $ids = $request->input('ids');

            // Validasi jika tidak ada data yang dipilih
            if (empty($ids)) {
                return redirect()->back()->with('error', 'Tidak ada produk yang dipilih.');
            }

            // Hapus stock berdasarkan ID yang dipilih
            $deletedCount = Stock::whereIn('id_stock', $ids)->delete();

            return redirect()->back()->with('success', "$deletedCount produk berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus produk.');
        }
    }



}
