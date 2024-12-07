<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;
use App\Models\Customer;
use App\Models\Berlangganan;

class OTPController extends Controller
{
    // Method untuk menyimpan data pengguna dan menyimpannya di cookies
    public function simpanDataDiri(Request $request)
    {
        $nik = $request->input('nik');
        $namaLengkap = $request->input('namaLengkap');
        $jenisKelamin = $request->input('jenisKelamin');
        $email = $request->input('email');
        $nomorHandphone = $request->input('nomorHandphone');
        $provinsi = $request->input('provinsi');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan');
        $kelurahan = $request->input('kelurahan');
        $kodepos = $request->input('kodepos');
        $idProduk = $request->input('idProduk');
        $alamat = $request->input('alamat');

        // Validasi jika data penting tidak ada
        if (!$nik || !$namaLengkap || !$email || !$nomorHandphone || !$alamat) {
            return redirect()->back()->withErrors('Data yang wajib diisi belum lengkap.');
        }

        $data = [
            'nik' => $nik,
            'namaLengkap' => $namaLengkap,
            'jenisKelamin' => $jenisKelamin,
            'email' => $email,
            'nomorHandphone' => $nomorHandphone,
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan,
            'kodepos' => $kodepos,
            'idProduk' => $idProduk,
            'alamat' => $alamat,
        ];

        // Simpan data ke cookies (hidup selama 60 menit)
        Cookie::queue('data', json_encode($data), 60);

        return redirect()->route('sendOTP');
    }

    // Method untuk mengirim OTP ke email
    public function sendOTP(Request $request)
    {
        $data = json_decode($request->cookie('data'), true);
        $email = $data['email'] ?? null;

        if (!$email) {
            return redirect()->back()->withErrors('Email tidak ditemukan.');
        }

        // Generate OTP 4 digit dan simpan ke session
        $otp = rand(1000, 9999);
        Session::put('otp', $otp);

        try {
            // Render template email dan kirim melalui Brevo
            $htmlContent = view('pesanProduk.email.emailOTP', compact('otp'))->render();
            $this->sendEmailWithBrevo($email, $htmlContent);

            return redirect()->route('verifikasiOTP')->with('success', 'OTP berhasil dikirim ke email!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Gagal mengirim email OTP: ' . $e->getMessage());
        }
    }

    private function sendEmailWithBrevo($to, $htmlContent)
    {
        // Konfigurasi Brevo API
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', env('BREVO_API_KEY'));
        $apiInstance = new TransactionalEmailsApi(new Client(), $config);

        // Data email
        $emailContent = [
            'subject' => 'Kode Verifikasi OTP Anda',
            'htmlContent' => $htmlContent,  // Konten HTML dari Blade template
            'sender' => ['email' => env('MAIL_FROM_ADDRESS'), 'name' => env('MAIL_FROM_NAME')],
            'to' => [['email' => $to, 'name' => $to]]
        ];

        // Kirim email
        $apiInstance->sendTransacEmail($emailContent);
    }

    public function simpanDataPemesanan(Request $request)
    {
        // Cek apakah OTP ada di session
        $otpSession = Session::get('otp');
        if (!$otpSession) {
            // Jika OTP tidak ada di session, arahkan kembali ke halaman sebelumnya
            return redirect()->back()->withErrors('OTP belum diverifikasi. Silakan verifikasi OTP terlebih dahulu.');
        }

        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'namaLengkap' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomorHandphone' => 'required|string|max:20',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kodepos' => 'required|string|max:10',
            'jenisKelamin' => 'required|string|max:10',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'id_produk' => 'required|exists:produk,id_produk',  // Sesuaikan dengan kolom primary key di tabel produk
            'otp' => 'required|string|size:4',  // Pastikan format OTP valid
        ]);

        // Gabungkan OTP dari setiap input menjadi satu string
        $otpEntered = $request->otp;

        // Verifikasi OTP yang dimasukkan dengan yang ada di session
        if ($otpEntered != $otpSession) {
            return redirect()->route('verifikasiOTP')->withErrors('OTP yang dimasukkan salah.');
        }

        // Proses penyimpanan data ke tabel Customer
        $customer = Customer::create([
            'nik' => $validated['nik'],
            'email_customer' => $validated['email'],
            'nama_customer' => $validated['namaLengkap'],
            'alamat_customer' => $validated['alamat'],
            'nomor_hp_customer' => $validated['nomorHandphone'],
            'provinsi' => $validated['provinsi'],
            'kota' => $validated['kota'],
            'kelurahan' => $validated['kelurahan'],
            'kode_pos' => $validated['kodepos'],
            'jenis_kelamin' => $validated['jenisKelamin'],
            'latitude' => $validated['latitude'] ?? null,  // Menggunakan null jika tidak ada
            'longitude' => $validated['longitude'] ?? null,  // Menggunakan null jika tidak ada
        ]);

        // Simpan data ke tabel Berlangganan
        Berlangganan::create([
            'id_customer' => $customer->id_customer,
            'id_produk' => $validated['id_produk'],
        ]);

        // Hapus OTP dari session setelah pemesanan berhasil
        Session::forget('otp');

        // Redirect ke halaman sukses atau lainnya...
        return redirect()->route('selesai')->with('success', 'Pemesanan berhasil');
    }
}
