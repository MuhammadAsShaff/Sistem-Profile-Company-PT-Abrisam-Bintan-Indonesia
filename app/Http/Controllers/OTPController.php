<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;


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
}
