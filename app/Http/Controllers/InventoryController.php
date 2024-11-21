<?php
namespace App\Http\Controllers;
use App\Models\InventoryKeluar;
use App\Models\InventoryMasuk;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function showInventoryMasuk()
    {
        // Ambil semua data dari tabel inventory_masuk
        $inventoryMasuk = InventoryMasuk::paginate(10);

        // Kirim data ke view
        return view('dashboard.inventory.inventoryMasuk.inventoryMasuk', [
            'inventoryMasuk' => $inventoryMasuk,
        ]);
    }

    public function showInventoryKeluar()
    {
        // Ambil semua data dari tabel inventory_keluar
        $inventoryKeluar = InventoryKeluar::paginate(10);

        // Kirim data ke view
        return view('dashboard.inventory.inventoryKeluar.inventoryKeluar', [
            'inventoryKeluar' => $inventoryKeluar,
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
}
