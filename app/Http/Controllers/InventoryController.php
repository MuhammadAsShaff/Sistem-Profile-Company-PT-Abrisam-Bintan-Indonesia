<?php
namespace App\Http\Controllers;
use App\Models\InventoryKeluar;
use App\Models\InventoryMasuk;
use App\Models\Stock;
use Illuminate\Http\Request;

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
        // Ambil semua data dari tabel inventory_keluar
        $inventoryKeluar = InventoryKeluar::paginate(10);

        // Hitung jumlah stock berdasarkan id_inventoryKeluar
        $jumlahStockKeluar = Stock::whereNotNull('id_inventoryKeluar')->count();

        // Kirim data ke view
        return view('dashboard.inventory.inventoryKeluar.inventoryKeluar', [
            'inventoryKeluar' => $inventoryKeluar,
            'jumlahStockKeluar' => $jumlahStockKeluar,
        ]);
    }


    // Method untuk Insert Inventory Masuk
    public function insertInventoryMasuk(Request $request)
    {
        $validatedData = $request->validate([
            'kategoriProduk' => 'required|string|unique:inventory_masuk,kategoriProduk',
        ]);

        // Tambahkan data ke Inventory Masuk
        $inventoryMasuk = InventoryMasuk::create([
            'kategoriProduk' => $validatedData['kategoriProduk'],
        ]);

        // Periksa jika kategori sudah ada di InventoryKeluar
        if (!InventoryKeluar::where('kategoriProduk', $validatedData['kategoriProduk'])->exists()) {
            InventoryKeluar::create([
                'kategoriProduk' => $validatedData['kategoriProduk'],
            ]);
        }

        return redirect()->route('inventoryMasuk')->with('success', 'Inventory Masuk berhasil ditambahkan.');
    }



    // Method untuk Insert Inventory Keluar
    public function insertInventoryKeluar(Request $request)
    {
        $validatedData = $request->validate([
            'kategoriProduk' => 'required|string|unique:inventory_keluar,kategoriProduk',
        ]);

        InventoryKeluar::create([
            'kategoriProduk' => $validatedData['kategoriProduk'],
        ]);

        return redirect()->route('inventoryKeluar')->with('success', 'Inventory Keluar berhasil ditambahkan.');
    }

    // Method untuk Delete Inventory Masuk
    public function deleteInventoryMasuk($id)
    {
        $inventoryMasuk = InventoryMasuk::findOrFail($id);

        // Menambahkan id_inventoryKeluar otomatis jika Inventory Masuk dihapus
        InventoryKeluar::where('kategoriProduk', $inventoryMasuk->kategoriProduk)
            ->update(['id_inventoryKeluar' => $inventoryMasuk->id]);

        $inventoryMasuk->delete();

        return redirect()->route('inventoryMasuk')->with('success', 'Inventory Masuk berhasil dihapus.');
    }

    // Method untuk Delete Inventory Keluar
    public function deleteInventoryKeluar($id)
    {
        $inventoryKeluar = InventoryKeluar::findOrFail($id);
        $inventoryKeluar->delete();

        return redirect()->route('inventoryKeluar')->with('success', 'Inventory Keluar berhasil dihapus.');
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


}
