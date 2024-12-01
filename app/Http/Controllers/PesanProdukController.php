<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
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
        // Ambil latitude dan longitude dari request
        $latitude = $request->input('latitude', env('DEFAULT_LATITUDE', 0.507068));
        $longitude = $request->input('longitude', env('DEFAULT_LONGITUDE', 101.447779));

        // Ambil ID produk yang dipilih dari request
        $produkId = $request->input('product_id');

        // Cari produk berdasarkan ID
        $produk = Produk::find($produkId);

        // Jika produk ditemukan, simpan ke cookie
        if ($produk) {
            // Enkripsi produk (gunakan json_encode) dan simpan ke cookie (expired dalam 60 menit)
            $cookie = cookie('selected_product', json_encode($produk), 60);  // 60 menit

            // Ambil kunci API untuk LocationIQ
            $locationIQApiKey = env('LOCATIONIQ_API_KEY');

            // Redirect ke halaman pesan produk dengan cookie dan kirim API key ke view
            return redirect()->route('pesanProduk')
                ->cookie($cookie)
                ->with('locationIQApiKey', $locationIQApiKey);
        } else {
            return redirect()->route('selesai')->with('error', 'Produk tidak ditemukan!');
        }
    }

    public function simpanAlamat(Request $request)
    {
        // Ambil latitude, longitude, alamat, dan data lokasi lainnya dari request
        $latitude = $request->input('lat');
        $longitude = $request->input('lon');
        $alamat = $request->input('alamatLengkap');
        $village = $request->input('village');
        $city = $request->input('city');
        $district = $request->input('district');
        $state = $request->input('state');
        $postcode = $request->input('postcode');
        $country = $request->input('country');
        $country_code = $request->input('country_code');

        // Validasi jika data lat, lon, atau alamat tidak ada
        if (!$latitude || !$longitude || !$alamat) {
            return redirect()->back()->with('error', 'Semua data harus diisi!');
        }

        // Membuat data lokasi dalam array
        $locationData = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'alamat' => $alamat,
            'village' => $village,
            'city' => $city,
            'district' => $district,
            'state' => $state,
            'postcode' => $postcode,
            'country' => $country,
            'country_code' => $country_code,
        ];

        // Enkripsi data lokasi (gunakan json_encode) dan simpan ke cookie (expired dalam 60 menit)
        $cookie = cookie('location_data', json_encode($locationData), 60); // Cookie expired dalam 60 menit

        // Redirect ke halaman isiDataDiri dengan cookie yang berisi data lokasi
        return redirect()->route('isiDataDiri')->cookie($cookie);
    }




    public function pesanProduk(Request $request)
    {
        // Ambil data produk dari cookie atau session
        $produk = json_decode($request->cookie('selected_product'), true);

        // Cek apakah produk tersedia
        if (!$produk) {
            // Jika produk tidak tersedia, bisa arahkan ke halaman lain atau tampilkan pesan error
            return redirect()->route('selesai')->with('error', 'Produk belum dipilih');
        }

        // Mengirimkan data produk dan API key ke view
        $locationIQApiKey = env('LOCATIONIQ_API_KEY');
        return view('pesanProduk.pesanProduk', compact('produk', 'locationIQApiKey'));
    }



    public function isiDataDiri(Request $request)
    {
        // Cek apakah produk ada di cookie
        $produk = json_decode($request->cookie('selected_product'), true);

        // Cek apakah data lokasi ada di cookie
        $locationData = json_decode($request->cookie('location_data'), true);

        // Jika produk tidak ada di cookie, arahkan ke halaman selesai dengan pesan error
        if (!$produk) {
            return redirect()->route('selesai')->with('error', 'Produk belum dipilih');
        }

        // Jika data lokasi ada di cookie, kirim ke view
        if ($locationData) {
            // Pass produk dan data lokasi ke view
            return view('pesanProduk.isiDataDiri', [
                'produk' => $produk,
                'latitude' => $locationData['latitude'],
                'longitude' => $locationData['longitude'],
                'alamat' => $locationData['alamat'],
                'village' => $locationData['village'] ?? '',   // Tambahkan ini
                'city' => $locationData['city'] ?? '',           // Tambahkan ini
                'district' => $locationData['district'] ?? '',   // Tambahkan ini
                'state' => $locationData['state'] ?? '',         // Tambahkan ini
                'postcode' => $locationData['postcode'] ?? '',   // Tambahkan ini
                'country' => $locationData['country'] ?? '',     // Tambahkan ini
                'country_code' => $locationData['country_code'] ?? '',  // Tambahkan ini
            ]);
        } else {
            // Jika tidak ada data lokasi, arahkan kembali ke halaman lokasi untuk memasukkan data lokasi
            return redirect()->route('showLocation')->with('error', 'Data lokasi tidak ditemukan!');
        }
    }



    // public function simpanAlamat(Request $request)
    // {
    //     // Validasi data
    //     $request->validate([
    //         'latitude' => 'required|numeric',
    //         'longitude' => 'required|numeric',
    //         'alamat' => 'required|string',
    //     ]);

    //     // Ambil data dari form
    //     $latitude = $request->input('latitude');
    //     $longitude = $request->input('longitude');
    //     $alamat = $request->input('alamat');

    //     // Simpan data ke cookies
    //     $geolocationData = [
    //         'latitude' => $latitude,
    //         'longitude' => $longitude,
    //         'alamat' => $alamat,
    //     ];

    //     // Set cookie dengan data geolocation
    //     Cookie::queue('geolocation_data', json_encode($geolocationData), 60); // 1 jam

    //     // Redirect atau tampilkan pesan sukses
    //     return redirect()->route('isiDataDiri')->with('success', 'Alamat berhasil disimpan!');
    // }


    public function selesai(){
        return view('pesanProduk.selesai');
    }
}
