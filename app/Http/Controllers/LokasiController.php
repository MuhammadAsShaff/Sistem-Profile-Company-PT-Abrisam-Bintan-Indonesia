<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    protected $locationService;

    // Inisialisasi LocationService melalui dependency injection
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    // Fungsi untuk menampilkan alamat berdasarkan koordinat
    public function showLocation(Request $request)
    {
        // Ambil latitude dan longitude dari request, atau gunakan default dari .env jika tidak ada
        $latitude = $request->input('latitude', env('DEFAULT_LATITUDE', 0.507068));
        $longitude = $request->input('longitude', env('DEFAULT_LONGITUDE', 101.447779));

        // Dapatkan alamat menggunakan LocationService
        $address = $this->locationService->getAddressFromCoordinates($latitude, $longitude);

        // Tampilkan hasil ke view (misalnya view bernama 'lokasi')
        return view('pesanProduk.pesanProduk', compact('address'));
    }

}
