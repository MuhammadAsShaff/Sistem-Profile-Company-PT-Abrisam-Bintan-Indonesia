<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Stock;

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

    // Kirim data ke view
    return view('dashboard.dashboard.dashboard', compact('admin', 'totalInventoryMasuk', 'totalInventoryKeluar','blogCount','onlineCount'));
  }


}
