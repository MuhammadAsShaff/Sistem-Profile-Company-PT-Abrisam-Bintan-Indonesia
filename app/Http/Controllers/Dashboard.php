<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth; // Import Auth
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Stock;
use App\Models\Customer;


class Dashboard extends Controller
{
  public function index()
  {
    // Ambil data admin yang sedang login
    $admin = Auth::guard('admin')->user();

    // Hitung total inventory masuk
    $totalInventoryMasuk = Stock::whereNotNull('id_inventoryMasuk')->count();
    $totalInventoryKeluar = Stock::whereNotNull('id_inventoryKeluar')->count();
    $blogCount = Blog::count();
    $onlineCount = Admin::where('status', 'Online')->count();
    $customers = Customer::orderBy('created_at', 'desc')->take(3)->get();
    $customerCountThisMonth = Customer::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)
      ->count();
    $produks = Kategori::withCount('produk')->take(3)->get();
    $customerPerbulan = Customer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
      ->groupBy('month')
      ->orderBy('month')
      ->get();

    // Konversi data untuk grafik
    $dataCustomer = [];
    for ($i = 1; $i <= 12; $i++) {
      $dataCustomer[] = $customerPerbulan->firstWhere('month', $i)->count ?? 0;
    }


    // Hitung jumlah inventory masuk per bulan
    $inventoryMasuk = Stock::selectRaw('MONTH(updated_at) as month, COUNT(id_stock) as total')
      ->whereNotNull('id_inventoryMasuk')
      ->groupByRaw('MONTH(updated_at)')
      ->pluck('total', 'month');

    // Hitung jumlah inventory keluar per bulan
    $inventoryKeluar = Stock::selectRaw('MONTH(updated_at) as month, COUNT(id_stock) as total')
      ->whereNotNull('id_inventoryKeluar')
      ->groupByRaw('MONTH(updated_at)')
      ->pluck('total', 'month');

    // Format data untuk dikirim ke view
    $inventoryMasukData = array_fill(0, 12, 0);
    foreach ($inventoryMasuk as $month => $total) {
      $inventoryMasukData[$month - 1] = $total; // Sesuaikan indeks bulan
    }

    $inventoryKeluarData = array_fill(0, 12, 0);
    foreach ($inventoryKeluar as $month => $total) {
      $inventoryKeluarData[$month - 1] = $total; // Sesuaikan indeks bulan
    }

    // Ambil data produk beserta jumlah customer berdasarkan tabel berlangganan
    // Ambil jumlah customer per kategori
    $kategoriData = Kategori::select('kategori.id_kategori', 'kategori.nama_kategori', \DB::raw('count(berlangganan.id_customer) as customer_count'))
      ->join('produk', 'produk.id_kategori', '=', 'kategori.id_kategori')
      ->join('berlangganan', 'berlangganan.id_produk', '=', 'produk.id_produk')
      ->groupBy('kategori.id_kategori', 'kategori.nama_kategori')
      ->get();

    // Siapkan data untuk chart
    $kategoriDataChart = $kategoriData->map(function ($item) {
      return [
        'label' => $item->nama_kategori, // Nama kategori produk
        'count' => $item->customer_count, // Jumlah customer
      ];
    });
    
    // Kirim data ke view
    return view('dashboard.dashboard.dashboard', compact('admin', 'totalInventoryMasuk', 'totalInventoryKeluar', 'blogCount', 'onlineCount', 'customerCountThisMonth', 'customers', 'produks','dataCustomer','inventoryMasukData', 'inventoryKeluarData','kategoriDataChart'));
  }


}
