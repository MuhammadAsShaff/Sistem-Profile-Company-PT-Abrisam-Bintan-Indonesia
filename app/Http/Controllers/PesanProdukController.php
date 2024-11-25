<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PesanProdukController extends Controller
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
        $latitude = $request->input('latitude', env('DEFAULT_LATITUDE', 0.507068));
        $longitude = $request->input('longitude', env('DEFAULT_LONGITUDE', 101.447779));
        $address = $this->locationService->getAddressFromCoordinates($latitude, $longitude);

        // Kirim kunci API ke view
        $locationIQApiKey = env('LOCATIONIQ_API_KEY');

        return view('pesanProduk.pesanProduk', compact('address', 'locationIQApiKey'));
    }

    public function storeSelection()
    {
        // Simpan status di session
        Session::put('selected_product', true);
        return redirect()->route('pesanProduk');
    }

    public function isiDataDiri()
    {
        return view('pesanProduk.isiDataDiri');
    }

}
